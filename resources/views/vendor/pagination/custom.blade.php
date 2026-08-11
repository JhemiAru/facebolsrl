@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation">
        <ul
            style="display: flex !important; flex-wrap: wrap !important; justify-content: center !important; align-items: center !important; gap: 4px !important; list-style: none !important; padding: 0 !important; margin: 0 !important;">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li style="margin: 0 !important;">
                    <span
                        style="display: inline-flex !important; align-items: center !important; justify-content: center !important; background: rgba(255, 255, 255, 0.05) !important; border: 1px solid rgba(255, 255, 255, 0.1) !important; color: #6b7280 !important; border-radius: 6px !important; padding: 5px 12px !important; font-weight: 600 !important; min-width: 34px !important; height: 34px !important; font-size: 0.8rem !important; line-height: 1 !important; opacity: 0.5 !important; cursor: not-allowed !important; text-decoration: none !important;">
                        &laquo;
                    </span>
                </li>
            @else
                <li style="margin: 0 !important;">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        style="display: inline-flex !important; align-items: center !important; justify-content: center !important; background: rgba(255, 255, 255, 0.08) !important; border: 1px solid rgba(88, 166, 255, 0.3) !important; color: #e2e8f0 !important; border-radius: 6px !important; padding: 5px 12px !important; font-weight: 700 !important; transition: all 0.3s ease !important; min-width: 34px !important; height: 34px !important; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important; font-size: 0.8rem !important; line-height: 1 !important; text-decoration: none !important;"
                        onmouseover="this.style.background='rgba(88, 166, 255, 0.25)'; this.style.borderColor='#58a6ff'; this.style.color='#ffffff'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 8px rgba(88, 166, 255, 0.3)';"
                        onmouseout="this.style.background='rgba(255, 255, 255, 0.08)'; this.style.borderColor='rgba(88, 166, 255, 0.3)'; this.style.color='#e2e8f0'; this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(0, 0, 0, 0.1)';">
                        &laquo;
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li style="margin: 0 !important;">
                        <span
                            style="display: inline-flex !important; align-items: center !important; justify-content: center !important; background: rgba(255, 255, 255, 0.08) !important; border: 1px solid rgba(88, 166, 255, 0.3) !important; color: #e2e8f0 !important; border-radius: 6px !important; padding: 5px 10px !important; font-weight: 600 !important; min-width: 34px !important; height: 34px !important; font-size: 0.8rem !important; line-height: 1 !important; text-decoration: none !important;">
                            {{ $element }}
                        </span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li style="margin: 0 !important;">
                                <span
                                    style="display: inline-flex !important; align-items: center !important; justify-content: center !important; background: linear-gradient(135deg, #58a6ff 0%, #3b82f6 100%) !important; border: 1px solid #58a6ff !important; color: #000000 !important; border-radius: 6px !important; padding: 5px 10px !important; font-weight: 700 !important; min-width: 34px !important; height: 34px !important; box-shadow: 0 4px 12px rgba(88, 166, 255, 0.5) !important; transform: scale(1.05) !important; font-size: 0.8rem !important; line-height: 1 !important; text-decoration: none !important;">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li style="margin: 0 !important;">
                                <a href="{{ $url }}"
                                    style="display: inline-flex !important; align-items: center !important; justify-content: center !important; background: rgba(255, 255, 255, 0.08) !important; border: 1px solid rgba(88, 166, 255, 0.3) !important; color: #e2e8f0 !important; border-radius: 6px !important; padding: 5px 10px !important; font-weight: 600 !important; transition: all 0.3s ease !important; min-width: 34px !important; height: 34px !important; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important; font-size: 0.8rem !important; line-height: 1 !important; text-decoration: none !important;"
                                    onmouseover="this.style.background='rgba(88, 166, 255, 0.25)'; this.style.borderColor='#58a6ff'; this.style.color='#ffffff'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 8px rgba(88, 166, 255, 0.3)';"
                                    onmouseout="this.style.background='rgba(255, 255, 255, 0.08)'; this.style.borderColor='rgba(88, 166, 255, 0.3)'; this.style.color='#e2e8f0'; this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(0, 0, 0, 0.1)';">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li style="margin: 0 !important;">
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                        style="display: inline-flex !important; align-items: center !important; justify-content: center !important; background: rgba(255, 255, 255, 0.08) !important; border: 1px solid rgba(88, 166, 255, 0.3) !important; color: #e2e8f0 !important; border-radius: 6px !important; padding: 5px 12px !important; font-weight: 700 !important; transition: all 0.3s ease !important; min-width: 34px !important; height: 34px !important; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important; font-size: 0.8rem !important; line-height: 1 !important; text-decoration: none !important;"
                        onmouseover="this.style.background='rgba(88, 166, 255, 0.25)'; this.style.borderColor='#58a6ff'; this.style.color='#ffffff'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 8px rgba(88, 166, 255, 0.3)';"
                        onmouseout="this.style.background='rgba(255, 255, 255, 0.08)'; this.style.borderColor='rgba(88, 166, 255, 0.3)'; this.style.color='#e2e8f0'; this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(0, 0, 0, 0.1)';">
                        &raquo;
                    </a>
                </li>
            @else
                <li style="margin: 0 !important;">
                    <span
                        style="display: inline-flex !important; align-items: center !important; justify-content: center !important; background: rgba(255, 255, 255, 0.05) !important; border: 1px solid rgba(255, 255, 255, 0.1) !important; color: #6b7280 !important; border-radius: 6px !important; padding: 5px 12px !important; font-weight: 600 !important; min-width: 34px !important; height: 34px !important; font-size: 0.8rem !important; line-height: 1 !important; opacity: 0.5 !important; cursor: not-allowed !important; text-decoration: none !important;">
                        &raquo;
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
