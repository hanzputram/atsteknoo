<!-- ========================================================
     FEATURED 7 TECHNICAL ARTICLES & ENGINEERING INSIGHTS
     PT. Anugerah Tama Sejati - SEO & AI Crawlable Section
     ======================================================== -->

<section class="home-articles-section" id="engineering-articles" itemscope itemtype="https://schema.org/ItemList">
  <div class="articles-container">

    <!-- Section Header with View All Link -->
    <div class="articles-header-row">
      <div class="articles-title-block">
        <div class="articles-badge-tag">
          <span class="pulse-dot"></span>
          <span>TECHNICAL INSIGHTS &amp; ENGINEERING STANDARDS</span>
        </div>
        <h2 class="articles-main-title" itemprop="name">Engineering Whitepapers &amp; Industrial Electrical Insights</h2>
        <p class="articles-sub-title">
          Authoritative guides on IEC 61439 switchboard sizing, harmonic mitigation, power factor correction, and protection coordination from Surabaya's premier electrical distributor.
        </p>
      </div>

      <div class="articles-header-cta">
        <a href="{{ route('articles.index') }}" class="btn-all-articles">
          <span>Explore All Articles</span>
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </div>
    </div>

    @if(isset($articles) && $articles->isNotEmpty())
      @php
        $featuredArticle = $articles->first();
        $gridArticles = $articles->slice(1, 6);
      @endphp

      <!-- 1. Hero Lead Article (Featured #1) -->
      @if($featuredArticle)
        <article class="article-lead-card" itemprop="itemListElement" itemscope itemtype="https://schema.org/BlogPosting">
          <meta itemprop="position" content="1">
          <div class="lead-media-wrap">
            <a href="{{ route('articles.show', $featuredArticle->slug) }}" class="lead-img-link" tabindex="-1">
              <img src="{{ $featuredArticle->thumbnail_url }}" alt="{{ $featuredArticle->title }}" class="lead-img" loading="eager" itemprop="image">
              <div class="lead-scrim"></div>
            </a>
            <span class="lead-category-chip" itemprop="articleSection">{{ $featuredArticle->category ? $featuredArticle->category->name : 'Switchboard Engineering' }}</span>
          </div>

          <div class="lead-content-wrap">
            <div class="lead-meta-row">
              <time datetime="{{ $featuredArticle->published_at ? $featuredArticle->published_at->toIso8601String() : now()->toIso8601String() }}" itemprop="datePublished" class="meta-item">
                🗓️ {{ $featuredArticle->published_at ? $featuredArticle->published_at->format('d M Y') : date('d M Y') }}
              </time>
              <span class="meta-dot">•</span>
              <span class="meta-item">⏱️ {{ $featuredArticle->read_time }}</span>
              <span class="meta-dot">•</span>
              <span class="meta-author" itemprop="author">{{ $featuredArticle->effective_author_name }}</span>
            </div>

            <h3 class="lead-title" itemprop="headline">
              <a href="{{ route('articles.show', $featuredArticle->slug) }}" itemprop="url">
                {{ $featuredArticle->title }}
              </a>
            </h3>

            <p class="lead-excerpt" itemprop="description">
              {{ $featuredArticle->excerpt }}
            </p>

            <div class="lead-footer-row">
              <a href="{{ route('articles.show', $featuredArticle->slug) }}" class="lead-read-btn">
                <span>Read Full Engineering Paper</span>
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </a>
              <span class="verified-badge">✓ Peer-Reviewed Industrial Guide</span>
            </div>
          </div>
        </article>
      @endif

      <!-- 2. Grid of 6 Supporting Articles (#2 to #7) -->
      @if($gridArticles->isNotEmpty())
        <div class="articles-six-grid">
          @foreach($gridArticles as $index => $art)
            <article class="article-grid-card" itemprop="itemListElement" itemscope itemtype="https://schema.org/BlogPosting">
              <meta itemprop="position" content="{{ $index + 2 }}">
              
              <div class="card-thumb-wrap">
                <a href="{{ route('articles.show', $art->slug) }}" class="card-thumb-link" tabindex="-1">
                  <img src="{{ $art->thumbnail_url }}" alt="{{ $art->title }}" class="card-thumb-img" loading="lazy" itemprop="image">
                  <div class="card-thumb-overlay"></div>
                </a>
                <span class="card-cat-badge">{{ $art->category ? $art->category->name : 'Technical Insight' }}</span>
              </div>

              <div class="card-body">
                <div class="card-meta-strip">
                  <time datetime="{{ $art->published_at ? $art->published_at->toIso8601String() : now()->toIso8601String() }}" itemprop="datePublished">
                    {{ $art->published_at ? $art->published_at->format('d M Y') : date('d M Y') }}
                  </time>
                  <span>•</span>
                  <span>{{ $art->read_time }}</span>
                </div>

                <h3 class="card-title" itemprop="headline">
                  <a href="{{ route('articles.show', $art->slug) }}" itemprop="url">
                    {{ $art->title }}
                  </a>
                </h3>

                <p class="card-excerpt" itemprop="description">
                  {{ Str::limit($art->excerpt, 110) }}
                </p>

                <div class="card-action-wrap">
                  <a href="{{ route('articles.show', $art->slug) }}" class="card-read-link">
                    <span>Read Article</span>
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                  </a>
                </div>
              </div>
            </article>
          @endforeach
        </div>
      @endif

    @endif

  </div>
</section>

<!-- ========================================================
     CSS STYLES: OPTIMIZED HARDWARE-ACCELERATED & ZERO-LAG
     ======================================================== -->
<style>
  .home-articles-section {
    position: relative;
    padding: 70px 24px 70px 24px;
    background: #FFFFFF;
    border-top: none;
    overflow: hidden;
  }

  .articles-container {
    max-width: 1280px;
    margin: 0 auto;
  }

  /* Header Row */
  .articles-header-row {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 24px;
    margin-bottom: 40px;
    flex-wrap: wrap;
  }

  .articles-title-block {
    max-width: 760px;
  }

  .articles-badge-tag {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 14px;
    border-radius: 9999px;
    background: #FFF1F2;
    border: 1px solid #FFE4E6;
    color: #E11D48;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    margin-bottom: 12px;
  }

  .articles-badge-tag .pulse-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #E11D48;
    animation: pingDot 2s cubic-bezier(0, 0, 0.2, 1) infinite;
  }

  @keyframes pingDot {
    0% { transform: scale(0.9); opacity: 1; }
    50% { transform: scale(1.4); opacity: 0.5; }
    100% { transform: scale(0.9); opacity: 1; }
  }

  .articles-main-title {
    font-size: clamp(24px, 3.2vw, 36px);
    font-weight: 800;
    color: #0F172A;
    font-family: var(--font-outfit, 'Outfit', sans-serif);
    letter-spacing: -0.02em;
    line-height: 1.2;
    margin-bottom: 12px;
  }

  .articles-sub-title {
    font-size: clamp(14px, 1.1vw, 16px);
    color: #475569;
    line-height: 1.6;
    font-family: var(--font-sans, 'Plus Jakarta Sans', sans-serif);
  }

  .btn-all-articles {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 20px;
    border-radius: 12px;
    background: #0F172A;
    color: #FFFFFF;
    text-decoration: none;
    font-size: 13.5px;
    font-weight: 600;
    transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
    white-space: nowrap;
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.1);
  }

  .btn-all-articles:hover {
    background: #E11D48;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(225, 29, 72, 0.25);
  }

  /* Lead Article (Hero Card) */
  .article-lead-card {
    display: grid;
    grid-template-columns: 1.1fr 1fr;
    gap: 36px;
    background: #FFFFFF;
    border: 1px solid #E2E8F0;
    border-radius: 24px;
    padding: 24px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
    margin-bottom: 36px;
    align-items: center;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
  }

  .article-lead-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 18px 40px rgba(0, 0, 0, 0.07);
    border-color: #CBD5E1;
  }

  .lead-media-wrap {
    position: relative;
    border-radius: 18px;
    overflow: hidden;
    aspect-ratio: 16 / 10;
    background: #0F172A;
  }

  .lead-img-link {
    display: block;
    width: 100%;
    height: 100%;
  }

  .lead-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.4s ease;
  }

  .article-lead-card:hover .lead-img {
    transform: scale(1.03);
  }

  .lead-scrim {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(0,0,0,0) 60%, rgba(0,0,0,0.5) 100%);
    pointer-events: none;
  }

  .lead-category-chip {
    position: absolute;
    top: 16px;
    left: 16px;
    background: rgba(15, 23, 42, 0.85);
    backdrop-filter: blur(8px);
    color: #FFFFFF;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.04em;
    padding: 5px 12px;
    border-radius: 9999px;
    text-transform: uppercase;
    border: 1px solid rgba(255, 255, 255, 0.15);
  }

  .lead-content-wrap {
    display: flex;
    flex-direction: column;
    gap: 14px;
    padding: 12px 8px;
  }

  .lead-meta-row {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 12.5px;
    color: #64748B;
    font-weight: 500;
  }

  .lead-title {
    font-size: clamp(20px, 2.2vw, 26px);
    font-weight: 800;
    line-height: 1.3;
    font-family: var(--font-outfit, 'Outfit', sans-serif);
    color: #0F172A;
  }

  .lead-title a {
    color: inherit;
    text-decoration: none;
    transition: color 0.2s ease;
  }

  .lead-title a:hover {
    color: #E11D48;
  }

  .lead-excerpt {
    font-size: 14.5px;
    color: #475569;
    line-height: 1.6;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .lead-footer-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 8px;
    flex-wrap: wrap;
    gap: 12px;
  }

  .lead-read-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #E11D48;
    font-weight: 700;
    font-size: 14px;
    text-decoration: none;
    transition: gap 0.2s ease;
  }

  .lead-read-btn:hover {
    gap: 12px;
  }

  .verified-badge {
    font-size: 11.5px;
    color: #059669;
    background: #ECFDF5;
    padding: 4px 10px;
    border-radius: 6px;
    font-weight: 600;
  }

  /* 6 Supporting Articles Grid */
  .articles-six-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
  }

  .article-grid-card {
    background: #FFFFFF;
    border: 1px solid #E2E8F0;
    border-radius: 18px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.02);
    transition: transform 0.2s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.2s ease, border-color 0.2s ease;
  }

  .article-grid-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.06);
    border-color: #CBD5E1;
  }

  .card-thumb-wrap {
    position: relative;
    aspect-ratio: 16 / 10;
    overflow: hidden;
    background: #0F172A;
  }

  .card-thumb-link {
    display: block;
    width: 100%;
    height: 100%;
  }

  .card-thumb-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.35s ease;
  }

  .article-grid-card:hover .card-thumb-img {
    transform: scale(1.05);
  }

  .card-cat-badge {
    position: absolute;
    bottom: 12px;
    left: 12px;
    background: rgba(15, 23, 42, 0.85);
    backdrop-filter: blur(6px);
    color: #FFFFFF;
    font-size: 10.5px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 6px;
    text-transform: uppercase;
    letter-spacing: 0.04em;
  }

  .card-body {
    padding: 20px;
    display: flex;
    flex-direction: column;
    flex: 1;
    gap: 10px;
  }

  .card-meta-strip {
    font-size: 11.5px;
    color: #94A3B8;
    display: flex;
    align-items: center;
    gap: 6px;
    font-weight: 500;
  }

  .card-title {
    font-size: 16px;
    font-weight: 700;
    line-height: 1.35;
    font-family: var(--font-outfit, 'Outfit', sans-serif);
    color: #0F172A;
  }

  .card-title a {
    color: inherit;
    text-decoration: none;
    transition: color 0.2s ease;
  }

  .card-title a:hover {
    color: #E11D48;
  }

  .card-excerpt {
    font-size: 13px;
    color: #64748B;
    line-height: 1.55;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .card-action-wrap {
    margin-top: auto;
    padding-top: 12px;
    border-top: 1px solid #F1F5F9;
  }

  .card-read-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 12.5px;
    font-weight: 700;
    color: #E11D48;
    text-decoration: none;
    transition: gap 0.2s ease;
  }

  .card-read-link:hover {
    gap: 9px;
  }

  /* Responsive Breakpoints */
  @media (max-width: 1024px) {
    .article-lead-card {
      grid-template-columns: 1fr;
      gap: 20px;
    }
    .articles-six-grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  @media (max-width: 640px) {
    .home-articles-section {
      padding: 56px 16px 40px 16px;
    }
    .articles-six-grid {
      grid-template-columns: 1fr;
      gap: 18px;
    }
    .article-lead-card {
      padding: 16px;
      border-radius: 18px;
    }
  }
</style>
