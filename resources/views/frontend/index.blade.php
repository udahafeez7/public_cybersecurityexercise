@extends('frontend.master')
@section('content')
    <section class="section pt-5 pb-5 products-section">
        <div class="container">
            <div class="section-header text-center">
                <h2>List of Cybersecurity Self Pace Materials</h2>
                <p>Various approaches on multi-dimensional Risk Assessment Activities</p>
                <span class="line"></span>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="moving-slider">
                        <!-- Item 1 -->
                        <div class="item">
                            <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                <div class="list-card-image">
                                    <div class="star position-absolute"><span class="badge badge-success"><i
                                                class="icofont-star"></i> 3.1 (300+)</span></div>
                                    <div class="favourite-heart text-danger position-absolute"><a
                                            href="{{ route('app.details') }}"><i class="icofont-heart"></i></a></div>
                                    <div class="member-plan position-absolute"><span
                                            class="badge badge-dark">Promoted</span></div>
                                    <a href="detail.html">
                                        <img src="{{ asset('frontend/img/list/1.png') }}" class="img-fluid item-img">
                                    </a>
                                </div>
                                <div class="p-3 position-relative">
                                    <div class="list-card-body">
                                        <h6 class="mb-1"><a href="detail.html" class="text-black">Multi Criteria Decision
                                                Making</a></h6>
                                        <p class="text-gray mb-3">Decision making aspects</p>
                                        <p class="text-gray mb-3 time"><span
                                                class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i
                                                    class="icofont-wall-clock"></i> 20–25 min</span></p>
                                    </div>
                                    <div class="list-card-badge">
                                        <span class="badge badge-success">OFFER</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Item 2 -->
                        <div class="item">
                            <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                <div class="list-card-image">
                                    <div class="star position-absolute"><span class="badge badge-warning"><i
                                                class="icofont-star"></i> 3.1 (300+)</span></div>
                                    <div class="favourite-heart text-danger position-absolute"><a href="detail.html"><i
                                                class="icofont-heart"></i></a></div>
                                    <div class="member-plan position-absolute"><span
                                            class="badge badge-dark">Promoted</span></div>
                                    <a href="detail.html">
                                        <img src="{{ asset('frontend/img/list/3.png') }}" class="img-fluid item-img">
                                    </a>
                                </div>
                                <div class="p-3 position-relative">
                                    <div class="list-card-body">
                                        <h6 class="mb-1"><a href="detail.html" class="text-black">System Complexity</a>
                                        </h6>
                                        <p class="text-gray mb-3">Best Practices • Assets Provisioned</p>
                                        <p class="text-gray mb-3 time"><span
                                                class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i
                                                    class="icofont-wall-clock"></i> 15–25 min</span></p>
                                    </div>
                                    <div class="list-card-badge">
                                        <span class="badge badge-danger">OFFER</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Item 3 -->
                        <div class="item">
                            <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                <div class="list-card-image">
                                    <div class="star position-absolute"><span class="badge badge-success"><i
                                                class="icofont-star"></i> 3.1 (300+)</span></div>
                                    <div class="favourite-heart text-danger position-absolute"><a href="detail.html"><i
                                                class="icofont-heart"></i></a></div>
                                    <div class="member-plan position-absolute"><span
                                            class="badge badge-danger">Promoted</span></div>
                                    <a href="detail.html">
                                        <img src="{{ asset('frontend/img/list/6.png') }}" class="img-fluid item-img">
                                    </a>
                                </div>
                                <div class="p-3 position-relative">
                                    <div class="list-card-body">
                                        <h6 class="mb-1"><a href="detail.html" class="text-black">Risk Level
                                                Determination</a>
                                        </h6>
                                        <p class="text-gray mb-3">Complexity • Exploitability • Impact</p>
                                        <p class="text-gray mb-3 time"><span
                                                class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i
                                                    class="icofont-wall-clock"></i> 15–25 min</span></p>
                                    </div>
                                    <div class="list-card-badge">
                                        <span class="badge badge-danger">OFFER</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Item 4 -->
                        <div class="item">
                            <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                <div class="list-card-image">
                                    <div class="star position-absolute"><span class="badge badge-success"><i
                                                class="icofont-star"></i> 3.1 (300+)</span></div>
                                    <div class="favourite-heart text-danger position-absolute"><a href="detail.html"><i
                                                class="icofont-heart"></i></a></div>
                                    <div class="member-plan position-absolute"><span
                                            class="badge badge-dark">Promoted</span></div>
                                    <a href="detail.html">
                                        <img src="{{ asset('frontend/img/list/8.png') }}" class="img-fluid item-img">
                                    </a>
                                </div>
                                <div class="p-3 position-relative">
                                    <div class="list-card-body">
                                        <h6 class="mb-1"><a href="detail.html" class="text-black">Mitigation
                                                Techniques</a>
                                        </h6>
                                        <p class="text-gray mb-3">Preventive • Detection • Corrective</p>
                                        <p class="text-gray mb-3 time"><span
                                                class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i
                                                    class="icofont-wall-clock"></i> 15–25 min</span></p>
                                    </div>
                                    <div class="list-card-badge">
                                        <span class="badge badge-danger">OFFER</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Item 5 -->
                        <div class="item">
                            <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                <div class="list-card-image">
                                    <div class="star position-absolute"><span class="badge badge-success"><i
                                                class="icofont-star"></i> 3.1 (300+)</span></div>
                                    <div class="favourite-heart text-danger position-absolute"><a href="detail.html"><i
                                                class="icofont-heart"></i></a></div>
                                    <div class="member-plan position-absolute"><span
                                            class="badge badge-dark">Promoted</span></div>
                                    <a href="detail.html">
                                        <img src="{{ asset('frontend/img/list/9.png') }}" class="img-fluid item-img">
                                    </a>
                                </div>
                                <div class="p-3 position-relative">
                                    <div class="list-card-body">
                                        <h6 class="mb-1"><a href="detail.html" class="text-black">Performance
                                                Indicator</a>
                                        </h6>
                                        <p class="text-gray mb-3">Administrative • Technical • Physical</p>
                                        <p class="text-gray mb-3 time"><span
                                                class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i
                                                    class="icofont-wall-clock"></i> 15–25 min</span></p>
                                    </div>
                                    <div class="list-card-badge">
                                        <span class="badge badge-danger">OFFER</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- End of moving-slider -->
                </div>
            </div>
        </div>
    </section>
@endsection

<!-- Add the following CSS in your stylesheet or within a <style> tag -->
<style>
    .moving-slider {
        display: flex;
        justify-content: space-around;
        align-items: center;
    }

    .moving-slider .item {
        opacity: 0;
        transform: scale(0.8);
        transition: opacity 1s ease-in-out, transform 1s ease-in-out;
    }

    .item.show {
        opacity: 1;
        transform: scale(1);
    }

    /* Ensure the section's overflow is hidden to prevent scrollbar */
    .products-section {
        overflow: hidden;
    }
</style>

<!-- Add the following JavaScript at the bottom of your page or inside your blade file -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const items = document.querySelectorAll('.moving-slider .item');
        let currentIndex = 0;

        function showNextItem() {
            items.forEach((item, index) => {
                item.classList.remove('show');
                if (index === currentIndex) {
                    item.classList.add('show');
                }
            });

            currentIndex++;

            if (currentIndex >= items.length) {
                setTimeout(() => {
                    items.forEach(item => item.classList.remove('show'));
                    currentIndex = 0;
                }, 3000); // Delay before fading out all items
            }

            setTimeout(showNextItem, currentIndex === 0 ? 10000 : 3000); // Adjust timing for fade-out
        }

        showNextItem();
    });
</script>
