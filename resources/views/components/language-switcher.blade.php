@props([
    'variant' => 'pill', // 'pill', 'compact', or 'footer'
    'class' => '',
])

@php
    $uniqueId = 'lang_switcher_' . uniqid();
@endphp

<div class="inline-flex items-center rounded-full p-1 border border-slate-200 dark:border-slate-700 bg-slate-100/90 dark:bg-slate-800 shadow-inner notranslate {{ $class }}"
     style="gap: 2px;"
     id="{{ $uniqueId }}">
    <button type="button"
            onclick="window.switchYonbusLanguage('en')"
            data-lang="en"
            class="yonbus-lang-btn px-2.5 py-1 rounded-full text-xs font-bold transition-all flex items-center gap-1.5 cursor-pointer bg-[#0052FF] text-white shadow-sm"
            title="English (Canada)">
        <span style="font-size: 13px;">🇨🇦</span>
        <span>EN</span>
    </button>
    <button type="button"
            onclick="window.switchYonbusLanguage('fr')"
            data-lang="fr"
            class="yonbus-lang-btn px-2.5 py-1 rounded-full text-xs font-bold transition-all flex items-center gap-1.5 cursor-pointer text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white"
            title="Français (Canada / Québec)">
        <span style="font-size: 13px;">⚜️</span>
        <span>FR</span>
    </button>
</div>
