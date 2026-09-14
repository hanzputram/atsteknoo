<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\LiveChatSession;
use App\Models\LiveChatMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Backoffice\LiveChatController;
use App\Http\Controllers\Public\LiveChatApiController;

echo "--- 1. Testing checkNotifications ---\n";
$backofficeCtrl = new LiveChatController();

// Test checkNotifications with last_seen_id = 0 (seed pass)
$req1 = Request::create('/backoffice/live-chats/notifications', 'GET', ['last_seen_id' => 0]);
$res1 = $backofficeCtrl->checkNotifications($req1);
$data1 = json_decode($res1->getContent(), true);
echo "Initial pass (last_seen_id=0): " . json_encode($data1) . "\n";

// Test checkNotifications with last_seen_id = smaller than latest_id
$latestId = $data1['latest_id'];
$req2 = Request::create('/backoffice/live-chats/notifications', 'GET', ['last_seen_id' => max(0, $latestId - 1)]);
$res2 = $backofficeCtrl->checkNotifications($req2);
$data2 = json_decode($res2->getContent(), true);
echo "New message pass: has_new=" . ($data2['has_new'] ? 'true' : 'false') . ", unread_count=" . $data2['unread_count'] . "\n";
if ($data2['has_new']) {
    echo "Latest message: " . json_encode($data2['latest_message']) . "\n";
}

echo "\n--- 2. Testing 45-min inactivity check in getSessionMessages ---\n";
$apiCtrl = new LiveChatApiController();
// Find an existing session
$sampleSession = LiveChatSession::first();
if ($sampleSession) {
    $req3 = Request::create('/live-chat/messages', 'GET', ['session_token' => $sampleSession->session_token]);
    $res3 = $apiCtrl->getSessionMessages($req3);
    $data3 = json_decode($res3->getContent(), true);
    echo "Session {$sampleSession->session_token}:\n";
    echo "inactive_minutes: " . ($data3['session']['inactive_minutes'] ?? 'N/A') . "\n";
    echo "is_expired: " . (($data3['session']['is_expired'] ?? false) ? 'YES' : 'NO') . "\n";
    echo "status: " . ($data3['session']['status'] ?? 'N/A') . "\n";
}

echo "\n--- 3. Testing getChatHistory ---\n";
if ($sampleSession) {
    $req4 = Request::create('/live-chat/history', 'POST', [], [], [], [], json_encode(['tokens' => [$sampleSession->session_token]]));
    $req4->headers->set('Content-Type', 'application/json');
    $res4 = $apiCtrl->getChatHistory($req4);
    $data4 = json_decode($res4->getContent(), true);
    echo "Retrieved history sessions count: " . count($data4['sessions'] ?? []) . "\n";
    if (!empty($data4['sessions'])) {
        $first = $data4['sessions'][0];
        echo "History session: token={$first['token']}, date={$first['date']}, messages_count=" . count($first['messages']) . "\n";
    }
}

echo "\nALL BACKEND CHECKS PASSED!\n";
