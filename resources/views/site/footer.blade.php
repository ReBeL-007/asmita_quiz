<!-- footer -->
<section id="footer">
    <div class="container ">
        <div class="row">
            <!-- <div class="col-md-3 footer-top">
                <p>Company</p>
            </div>
            <div class="col-md-3 footer-top">
                <p>Community</p>
            </div>
            <div class="col-md-3 footer-top">
                <p>Teaching</p>
            </div>
            <div class="col-md-3 footer-top">
                <p>Mobile</p>
            </div> -->
        </div>

        <div class="footer-end">
            <div class="row">
                <div class="col-md-7">
                    <div class="left">
                        <span><b> Sikaai</b></span><br>
                        <span>Help</span>
                        <span>Privacy Policy</span>
                        <span>Terms & Conditions</span>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="right">
                        <a href="https://www.facebook.com/sikaai/" target="_blank"><img
                                src="{{ asset('frontend/img/jam_facebook-circle.png')}}" alt=""></a>
                        <a href="https://www.instagram.com/sikaai_/" target="_blank"><img
                                src="{{ asset('frontend/img/entypo-social_instagram-with-circle.png')}}" alt="">
                        </a>
                        <a href="https://www.linkedin.com/company/sikaai" target="_blank"><img
                                src="{{ asset('frontend/img/linked.png')}}" alt=""></a>
                        <a href="#"><img src="{{ asset('frontend/img/Group 382.png')}}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $("#customer-testimonoals").owlCarousel({
        loop: true,
        center: true,
        items: 3,
        margin: 0,
        autoplay: false,
        dots: true,
        autoplayTimeout: 8500,
        smartSpeed: 450,
        nav: false,
        responsive: {
          0: {
            items: 1,
          },
          600: {
            items: 3,
          },
          1000: {
            items: 3,
          },
        },
      });
</script>
<script>
    $(document).ready(function () {
        setTimeout(function () {
            $(".alert").remove();
        }, 5000); // 5 secs

        const href = window.location.href.split('/');
            const modal = href[href.length-1];
            if(window.location.href.indexOf(modal) != -1) {
            $(modal).modal('show');
            }

    });
</script>
@yield('scripts')
</div>
