<!-- ========================================================
     FLOATING SIDEBAR BUTTON: BUY AT LISTRIKONLINE
     Pinned to the left edge of the viewport across all pages
     ======================================================== -->
<a href="https://listrikonline.com" 
   target="_blank" 
   rel="noopener noreferrer" 
   class="floating-listrikonline-btn" 
   id="floatingListrikonlineBtn"
   aria-label="Buy at Listrikonline"
   title="Beli Perlengkapan &amp; Komponen Listrik Resmi di ListrikOnline.com">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130 455" fill="none" class="listrikonline-svg-shape">
        <g filter="url(#filter0_d_listrikonline)">
            <path d="M64.787 37.7335L42.0322 25.2622C29.3702 18.3224 13.9004 27.4847 13.9004 41.9238V412.937C13.9004 427.991 30.573 437.066 43.2153 428.893L65.97 414.183C71.385 410.683 74.6551 404.675 74.6551 398.227V350.243C74.6551 344.72 77.0582 339.471 81.2386 335.862L90.8169 327.592C94.9973 323.983 97.4004 318.733 97.4004 313.21V167.53C97.4004 162.007 94.9973 156.757 90.8169 153.148L81.2386 144.879C77.0582 141.269 74.6551 136.02 74.6551 130.497V54.3951C74.6551 47.4559 70.8721 41.0686 64.787 37.7335Z" fill="#D40000"/>
        </g>
        <!-- Chevron pointing right into the page -->
        <path d="M82 232 L90 240 L82 248" stroke="#FFFFFF" stroke-width="3.2" stroke-linecap="round" stroke-linejoin="round"/>
        <!-- Vertical text BUY AT LISTRIKONLINE -->
        <text x="44" y="227" transform="rotate(90, 44, 227)" text-anchor="middle" dominant-baseline="central" font-family="'Outfit', 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif" font-weight="500" font-size="18.5" fill="#FFFFFF" letter-spacing="2.2">
            <tspan class="ats-lang-en">SHOP NOW AT LISTRIKONLINE</tspan>
            <tspan class="ats-lang-id">BELANJA DI LISTRIKONLINE</tspan>
        </text>
        <defs>
            <filter id="filter0_d_listrikonline" x="0.000391006" y="-0.00156212" width="129.3" height="454.87" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                <feOffset dx="9"/>
                <feGaussianBlur stdDeviation="11.45"/>
                <feComposite in2="hardAlpha" operator="out"/>
                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_1007_6"/>
                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_1007_6" result="shape"/>
            </filter>
        </defs>
    </svg>
</a>

<style>
    .floating-listrikonline-btn {
        position: fixed;
        left: -14.5px;
        top: 50%;
        transform: translateY(-50%);
        z-index: 9990;
        display: block;
        width: 72px;
        height: auto;
        transition: transform 0.28s cubic-bezier(0.16, 1, 0.3, 1), filter 0.25s ease;
        cursor: pointer;
        user-select: none;
        -webkit-user-drag: none;
    }

    .floating-listrikonline-btn .listrikonline-svg-shape {
        display: block;
        width: 100%;
        height: auto;
        overflow: visible;
        filter: drop-shadow(0 8px 24px rgba(212, 0, 0, 0.25));
    }

    .floating-listrikonline-btn:hover {
        transform: translateY(-50%) translateX(6px);
        filter: brightness(1.08);
    }

    .floating-listrikonline-btn:active {
        transform: translateY(-50%) translateX(3px) scale(0.98);
    }

    @media (max-width: 768px) {
        .floating-listrikonline-btn {
            width: 52px;
            left: -10px;
            top: 55%;
        }
        .floating-listrikonline-btn:hover,
        .floating-listrikonline-btn:focus-visible {
            transform: translateY(-50%) translateX(8px);
        }
    }

    @media (max-width: 480px) {
        .floating-listrikonline-btn {
            width: 44px;
            left: -14px;
            top: 58%;
        }
        .floating-listrikonline-btn:hover,
        .floating-listrikonline-btn:focus-visible {
            transform: translateY(-50%) translateX(12px);
        }
    }
</style>
