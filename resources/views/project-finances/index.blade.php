@extends('layouts.app')

@push('datatable-styles')
    @include('sections.datatable_css')
@endpush

@section('filter-section')
    <div class="d-flex d-lg-block filter-box project-header bg-white">
        <div class="mobile-close-overlay w-100 h-100" id="close-client-overlay"></div>

        <div class="project-menu overflow-scroll" id="mob-client-detail">
            <a class="d-none close-it" href="javascript:;" id="close-client-detail">
                <i class="fa fa-times"></i>
            </a>

            <nav class="tabs">
                <ul class="-primary">

                    <li>
                        <x-tab :href="route('dashboard')" :text="__('modules.projects.tabs.preliminary')" ajax="false" class="preliminary" />
                    </li>

                    <li>
                        <x-tab :href="route('dashboard') . '?tab=licenses'" :text="__('modules.projects.tabs.licenses')" ajax="false" class="licenses" />
                    </li>

                    <li>
                        <x-tab :href="route('dashboard') . '?tab=urbanization'" :text="__('modules.projects.tabs.urbanization')" ajax="false" class="urbanization" />
                    </li>

                    <li>
                        <x-tab :href="route('dashboard') . '?tab=building'" :text="__('modules.projects.tabs.building')" ajax="false" class="building" />
                    </li>

                    <li>
                        <x-tab :href="route('dashboard') . '?tab=concrete'" :text="__('modules.projects.tabs.concrete')" ajax="false" class="concrete" />
                    </li>

                    <li>
                        <x-tab :href="route('dashboard') . '?tab=steel'" :text="__('modules.projects.tabs.steel')" ajax="false" class="steel" />
                    </li>

                    <li>
                        <x-tab :href="route('dashboard') . '?tab=masonry'" :text="__('modules.projects.tabs.masonry')" ajax="false" class="masonry" />
                    </li>

                    <li>
                        <x-tab :href="route('dashboard') . '?tab=materials'" :text="__('modules.projects.tabs.materials')" ajax="false" class="materials" />
                    </li>

                    <li>
                        <x-tab :href="route('dashboard') . '?tab=finishes'" :text="__('modules.projects.tabs.finishes')" ajax="false" class="finishes" />
                    </li>

                    <li>
                        <x-tab :href="route('dashboard') . '?tab=plumbing'" :text="__('modules.projects.tabs.plumbing')" ajax="false" class="plumbing" />
                    </li>

                    <li>
                        <x-tab :href="route('dashboard') . '?tab=wiring'" :text="__('modules.projects.tabs.wiring')" ajax="false" class="wiring" />
                    </li>

                    <li>
                        <x-tab :href="route('dashboard') . '?tab=kitchens'" :text="__('modules.projects.tabs.kitchens')" ajax="false" class="kitchens" />
                    </li>

                    <li>
                        <x-tab :href="route('dashboard') . '?tab=capentry'" :text="__('modules.projects.tabs.capentry')" ajax="false" class="capentry" />
                    </li>

                    <li>
                        <x-tab :href="route('dashboard') . '?tab=metalworking'" :text="__('modules.projects.tabs.metalworking')" ajax="false" class="metalworking" />
                    </li>

                    <li>
                        <x-tab :href="route('dashboard') . '?tab=painting'" :text="__('modules.projects.tabs.painting')" ajax="false" class="painting" />
                    </li>

                    <li>
                        <x-tab :href="route('dashboard') . '?tab=creditnotes'" :text="__('modules.projects.tabs.aircon')" ajax="false" class="creditnotes" />
                    </li>

                    <li>
                        <x-tab :href="route('dashboard') . '?tab=waterproofing'" :text="__('modules.projects.tabs.waterproofing')" ajax="false" class="waterproofing" />
                    </li>

                    <li>
                        <x-tab :href="route('dashboard') . '?tab=gardening'" :text="__('modules.projects.tabs.gardening')" ajax="false" class="gardening" />
                    </li>

                    <li>
                        <x-tab :href="route('dashboard') . '?tab=walls'" :text="__('modules.projects.tabs.walls')" ajax="false" class="walls" />
                    </li>

                    <li>
                        <x-tab :href="route('dashboard') . '?tab=additionalCosts'" :text="__('modules.projects.tabs.additionalCosts')" ajax="false" class="additionalCosts" />
                    </li>

                    <li>
                        <x-tab :href="route('dashboard') . '?tab=otherCosts'" :text="__('modules.projects.tabs.otherCosts')" ajax="false" class="otherCosts" />
                    </li>

                    <li>
                        <x-tab :href="route('dashboard') . '?tab=operation'" :text="__('modules.projects.tabs.operation')" ajax="false" class="operation" />
                    </li>
                </ul>
            </nav>
        </div>

        <a class="d-block d-lg-none text-dark-grey border-left-grey mb-0 ml-auto mr-2"
            onclick="openClientDetailSidebar()"><i class="fa fa-ellipsis-v"></i></a>

    </div>
@endsection

@section('content')
    <div class="content-wrapper border-top-0 client-detail-wrapper">
        @include($view)
    </div>
@endsection

@push('scripts')
    <script>
        $("body").on("click", ".project-menu .ajax-tab", function(event) {
            event.preventDefault();

            $('.project-menu .p-sub-menu').removeClass('active');
            $(this).addClass('active');

            const requestUrl = this.href;

            $.easyAjax({
                url: requestUrl,
                blockUI: true,
                container: ".content-wrapper",
                historyPush: true,
                success: function(response) {
                    if (response.status == "success") {
                        $('.content-wrapper').html(response.html);
                        init('.content-wrapper');
                    }
                }
            });
        });
    </script>
    <script>
        const activeTab = "{{ $activeTab }}";
        $('.project-menu .' + activeTab).addClass('active');
    </script>
    <script>
        /*******************************************************
                
                More btn in projects menu Start
                                            *******************************************************/

        const container = document.querySelector('.tabs');
        const primary = container.querySelector('.-primary');
        const primaryItems = container.querySelectorAll('.-primary > li:not(.-more)');
        container.classList.add('--jsfied'); // insert "more" button and duplicate the list

        primary.insertAdjacentHTML('beforeend', `
        <li class="-more">
            <button type="button" class="px-4 h-100 bg-grey d-none d-lg-flex align-items-center" aria-haspopup="true" aria-expanded="false">
            {{ __('app.more') }} <span>&darr;</span>
            </button>
            <ul class="-secondary" id="hide-project-menues">
            ${primary.innerHTML}
            </ul>
        </li>
        `);
        const secondary = container.querySelector('.-secondary');
        const secondaryItems = secondary.querySelectorAll('li');
        const allItems = container.querySelectorAll('li');
        const moreLi = primary.querySelector('.-more');
        const moreBtn = moreLi.querySelector('button');
        moreBtn.addEventListener('click', e => {
            e.preventDefault();
            container.classList.toggle('--show-secondary');
            moreBtn.setAttribute('aria-expanded', container.classList.contains('--show-secondary'));
        }); // adapt tabs

        const doAdapt = () => {
            // reveal all items for the calculation
            allItems.forEach(item => {
                item.classList.remove('--hidden');
            }); // hide items that won't fit in the Primary

            let stopWidth = moreBtn.offsetWidth;
            let hiddenItems = [];
            const primaryWidth = primary.offsetWidth;
            primaryItems.forEach((item, i) => {
                if (primaryWidth >= stopWidth + item.offsetWidth) {
                    stopWidth += item.offsetWidth;
                } else {
                    item.classList.add('--hidden');
                    hiddenItems.push(i);
                }
            }); // toggle the visibility of More button and items in Secondary

            if (!hiddenItems.length) {
                moreLi.classList.add('--hidden');
                container.classList.remove('--show-secondary');
                moreBtn.setAttribute('aria-expanded', false);
            } else {
                secondaryItems.forEach((item, i) => {
                    if (!hiddenItems.includes(i)) {
                        item.classList.add('--hidden');
                    }
                });
            }
        };

        doAdapt(); // adapt immediately on load

        window.addEventListener('resize', doAdapt); // adapt on window resize
        // hide Secondary on the outside click

        document.addEventListener('click', e => {
            let el = e.target;

            while (el) {
                if (el === secondary || el === moreBtn) {
                    return;
                }

                el = el.parentNode;
            }

            container.classList.remove('--show-secondary');
            moreBtn.setAttribute('aria-expanded', false);
        });
        /*******************************************************
                 More btn in projects menu End
        *******************************************************/
    </script>
@endpush
