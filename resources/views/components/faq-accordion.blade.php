@props(['faqs' => []])

@if(!empty($faqs) && is_array($faqs))
@php
    $faqSchemaEntities = [];
    foreach ($faqs as $item) {
        $faqSchemaEntities[] = [
            '@type' => 'Question',
            'name' => $item['q_id'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => $item['a_id'],
            ],
        ];
    }

    $faqSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => $faqSchemaEntities,
    ];

    $faqSchemaJson = json_encode(
        $faqSchema,
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT
    );
@endphp

@push('schema')
<script type="application/ld+json">
{!! $faqSchemaJson !!}
</script>
@endpush

<section class="mt-12 pt-10 border-t border-slate-200/90" aria-labelledby="faq-heading">
    <div class="flex items-center gap-3 mb-6">
        <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center font-bold text-lg border border-rose-100/80 shadow-sm">
            ?
        </div>
        <div>
            <h2 id="faq-heading" class="text-xl sm:text-2xl font-bold text-slate-900 font-outfit">
                <span class="ats-lang-id">Pertanyaan Sering Diajukan (FAQ)</span>
                <span class="ats-lang-en">Frequently Asked Questions (FAQ)</span>
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 mt-0.5">
                <span class="ats-lang-id">Jawaban teknis, standar garansi resmi, dan ketersediaan stok di Surabaya.</span>
                <span class="ats-lang-en">Technical specifications, official warranty standards, and stock availability in Surabaya.</span>
            </p>
        </div>
    </div>

    <div class="space-y-3" x-data="{ active: null }">
        @foreach($faqs as $index => $item)
            <details class="group bg-white rounded-2xl border border-slate-200/90 hover:border-slate-300 shadow-sm transition-all duration-200 overflow-hidden" {{ $index === 0 ? 'open' : '' }}>
                <summary class="flex items-center justify-between p-4 sm:p-5 cursor-pointer font-semibold text-slate-900 hover:text-rose-600 select-none transition-colors text-sm sm:text-base list-none [&::-webkit-details-marker]:hidden">
                    <span class="flex items-center gap-3 pr-4">
                        <span class="w-6 h-6 rounded-full bg-slate-100 text-slate-600 text-xs font-bold flex items-center justify-center flex-shrink-0 group-hover:bg-rose-100 group-hover:text-rose-700 transition">
                            {{ $index + 1 }}
                        </span>
                        <span class="ats-lang-id">{{ $item['q_id'] }}</span>
                        <span class="ats-lang-en">{{ $item['q_en'] }}</span>
                    </span>
                    <svg class="w-5 h-5 text-slate-400 group-open:rotate-180 transition-transform duration-200 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </summary>
                <div class="px-5 pb-5 pt-1 text-slate-600 text-sm leading-relaxed border-t border-slate-100 mt-1 bg-slate-50/50">
                    <p class="ats-lang-id mt-2 font-normal text-slate-700">{{ $item['a_id'] }}</p>
                    <p class="ats-lang-en mt-2 font-normal text-slate-700">{{ $item['a_en'] }}</p>
                </div>
            </details>
        @endforeach
    </div>
</section>
@endif
