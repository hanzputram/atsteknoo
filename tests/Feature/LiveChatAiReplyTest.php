<?php

use App\Models\LiveChatMessage;
use App\Models\LiveChatSession;
use App\Models\Product;
use App\Models\Brand;
use App\Models\SiteSetting;

beforeEach(function () {
    // Ensure gemini api key is present
    $defaultKey = base64_decode('QVEuQWI4Uk42Sk9vMVlGNTJyajNyUmpmNHJiTU42RVktZ3UzTk92cGo1OEVvQ1B2Y0RqbXc=');
    SiteSetting::updateOrCreate(
        ['key' => 'gemini_api_key'],
        ['value' => $defaultKey, 'group' => 'integration']
    );
});

test('Live chat visitor message receives automatic AI reply with catalog intelligence', function () {
    $session = LiveChatSession::create([
        'session_token' => 'test_feature_' . uniqid(),
        'visitor_name' => 'Budi Santoso',
        'visitor_contact' => '08123456789',
        'status' => 'active',
        'ai_enabled' => true,
        'is_archived' => false,
        'needs_human_takeover' => false,
    ]);

    $response = $this->postJson('/live-chat/send', [
        'session_token' => $session->session_token,
        'name' => 'Budi Santoso',
        'contact' => '08123456789',
        'message' => 'Halo apakah PT ATS adalah authorized dealer resmi Schneider Electric?',
    ]);

    $response->assertOk();
    $response->assertJsonStructure([
        'success',
        'session_token',
        'message' => ['id', 'sender', 'is_ai', 'message', 'time'],
        'ai_reply' => ['id', 'sender', 'is_ai', 'message', 'time'],
    ]);

    $data = $response->json();
    expect($data['success'])->toBeTrue();
    expect($data['ai_reply'])->not->toBeNull();
    expect($data['ai_reply']['sender'])->toBe('admin');
    expect($data['ai_reply']['is_ai'])->toBeTrue();
    expect(strtolower($data['ai_reply']['message']))->toContain('schneider');
});

test('Follow-up message from visitor does not get blocked by anti-collision check', function () {
    $session = LiveChatSession::create([
        'session_token' => 'test_followup_' . uniqid(),
        'visitor_name' => 'hanz',
        'visitor_contact' => '0895605888564',
        'status' => 'active',
        'ai_enabled' => true,
        'is_archived' => false,
        'needs_human_takeover' => false,
        'admin_engaged_at' => now()->subMinutes(10), // Admin chatted 10 mins ago
    ]);

    // Admin message in the past
    LiveChatMessage::create([
        'session_id' => $session->id,
        'sender' => 'admin',
        'message' => 'ada kak',
        'is_ai' => false,
        'created_at' => now()->subMinutes(10),
    ]);

    // Visitor sends first question
    $res1 = $this->postJson('/live-chat/send', [
        'session_token' => $session->session_token,
        'name' => 'hanz',
        'contact' => '0895605888564',
        'message' => 'saya mau beli inverter kak dengan spek 7,5kw',
    ]);

    $res1->assertOk();
    expect($res1->json('ai_reply'))->not->toBeNull();

    // Visitor sends second question immediately
    $res2 = $this->postJson('/live-chat/send', [
        'session_token' => $session->session_token,
        'name' => 'hanz',
        'contact' => '0895605888564',
        'message' => 'saya mau beli inverter kak dengan spek 7,5kw Anda',
    ]);

    $res2->assertOk();
    expect($res2->json('ai_reply'))->not->toBeNull();
});
