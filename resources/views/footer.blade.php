
<script>
    function FuncHideModal() {
        var x = document.getElementById("indexModal");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>
<style>
    .video-container {
        position: relative;
        padding-bottom: 56.25%;
    }

    .video-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
</style>
<center><img src="https://uploadstatic-sea.mihoyo.com/contentweb/20210717/2021071716211547763.png" class="city__icon">
</center>


<footer class="mt-5 p-3" style="background: rgb(27 25 60 / 58%);color: #fff; margin-right: -6px; margin-left: -8px">
    <div class="container-lg">
        <div class="row">
            <section class="col-12 col-lg-4">
                <div class="h h4 link-active">Về Shop Genshin Impact Top 1 VN - Uy Tín - An Toàn
                </div>
                <p><span style="color: rgb(255, 255, 255);">
                        <p>* Đã có hơn 10000 khách hàng mua nick thành c&ocirc;ng<br />
                            * Giao dịch đơn giản, nhanh gọn<br />
                            * L&agrave;m việc chuy&ecirc;n nghiệp<br />
                            * Hỗ trợ nhiệt t&igrave;nh<br />
                            * Ch&uacute;c c&aacute;c bạn chơi game vui vẻ</p>
                    </span><br></p>
            </section>
            <section class="col-12 col-lg-4">
                <div class="h h4 link-active">Chúng tôi...</div>
                <p class="m-0">
                <p>Lu&ocirc;n lấy uy t&iacute;n l&agrave;m h&agrave;ng đầu đối với kh&aacute;ch
                    h&agrave;ng.<br />
                    Hi vọng sẽ được phục vụ c&aacute;c bạn chu đ&aacute;o nhất. Cảm ơn!</p>
                </p>
                <p class="mt-3 fw-bold"><i class="fa fa-phone mr-2"></i>Hotline: <a href="tel:0">0</a> (8h-22h)</p>
                <p class="fw-bold"><i class="fa fa-clock mr-2"></i>Work time: 8h - 24h</p>
            </section>
            <section class="col-12 col-lg-4">
                <i class="fab fa-facebook-square fa-2x mr-2"></i>
                <i class="fab fa-youtube fa-2x"></i>
            </section>
        </div>
    </div>
</footer>
</div>
</section>
</main>
</div>
</div>
<div id="thongbao"></div>
<style>
    .lazy-background {
        background-image: url(https://accgamegenshin.com/assets/storage/images/loading.png?ver=new_by_hanamweb) !important;
        background-size: cover;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
</script>
<script>
    $('.copy').click(function() {
        $("#copyClipboard").text($(this).next('input').val());
        myFunction();
        cuteToast({
            type: "success",
            message: "Đã copy nội dung",
            timer: 1000
        });
    })

    function myFunction() {
        var copyText = document.getElementById("copyClipboard");
        var input = document.createElement("INPUT");
        document.body.appendChild(input);
        input.value = copyText.innerHTML;
        input.select();
        input.setSelectionRange(0, 99999);
        document.execCommand("copy");
        document.body.removeChild(input);
    }
    $('[data-toggle="tooltip"]').tooltip();
    var img_lazy = $('img.lazyLoad');
    img_lazy.each(function() {
        if ($(this).attr('src') == undefined && $(this).offset().top <= $(window).height()) {
            $(this).attr('src', $(this).attr("data-src"));
        }
    })
    $(window).scroll(function() {
        var offset = $(this).scrollTop();
        img_lazy.each(function() {
            if ($(this).attr('src') == undefined && $(this).offset().top < (offset + $(window)
                    .height() - 100)) {
                $(this).attr('src', $(this).attr("data-src"));
            }
        })
    });
    document.addEventListener("DOMContentLoaded", function() {
        if ($('#slider .owl-carousel').length > 0) {
            $('#slider .owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                items: 1,
                autoplay: true,
                lazyLoad: true,
                autoplayHoverPause: true,
            })
            $('#slider-post.owl-carousel').owlCarousel({
                loop: false,
                margin: 10,
                nav: true,
                items: 4,
                autoplay: true,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    500: {
                        items: 2
                    },
                    800: {
                        items: 3
                    },
                    900: {
                        items: 4
                    }
                }
            })
        }
        var lazyBackgrounds = [].slice.call(document.querySelectorAll(".lazy-background"));
        if ("IntersectionObserver" in window) {
            let lazyBackgroundObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.remove("lazy-background");
                        lazyBackgroundObserver.unobserve(entry.target);
                    }
                });
            });

            lazyBackgrounds.forEach(function(lazyBackground) {
                lazyBackgroundObserver.observe(lazyBackground);
            });
        }
    });
</script>
</div>
<div id='arcontactus' data-messenger="" data-viber="" data-phone="0"
    data-zalo="https://zalo.me/0399921431"></div>
<link class="main-stylesheet" href="{{ asset('/template/cute-alert/style.css') }}" rel="stylesheet"
    type="text/css">
<script src="{{ asset('/template/cute-alert/cute-alert.js') }}" defer type="text/javascript"></script>
<script src="{{ asset('/template/cute-alert/style.css') }}" type="text/javascript"></script>
<script src="{{ asset('/assets/storage/js/acc.owl.carousel.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script src="{{ asset('asset/js/js.js') }}"></script>

<script src="https://accgamegenshin.com/template/contacts.js?ver=1.0" type="text/javascript" defer></script>
</body>
{{-- <script type="text/javascript">
    $("#btnThanhToan").on("click", function() {
        $('#btnThanhToan').html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled',
            true);

        Swal.fire({
            title: 'Xác Nhận Thanh Toán',
            text: "Bạn có đồng ý mua nick này không ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Mua ngay'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "https://accgamegenshin.com/assets/ajaxs/Orders.php",
                    method: "POST",
                    data: {
                        id: 34710
                    },
                    success: function(response) {
                        $("#thongbao").html(response);
                        $('#btnThanhToan').html(
                                'THANH TOÁN')
                            .prop('disabled', false);
                    }
                });
            } else {
                $('#btnThanhToan').html(
                        'THANH TOÁN')
                    .prop('disabled', false);
            }
        })

    });
    
</script> --}}
    <script type="text/javascript">
        $("#btnCart").on("click", function() {
            $('#btnCart').html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled',
                true);

            

        });
        
    </script>
</html>
