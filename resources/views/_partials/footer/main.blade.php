<footer>
    <div class="footer-inner py-3">
        <div class="container-fluid px-4">
            <div class="row">
                <div class="col-md-1 col-sm-12 col-xs-12">
                    <img src="{{ asset('images/candsedit.png') }}" alt="logo" class="w-100 h-100">
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12 mb-2">
                    <h6 class="text-custom-primary h5 font-weight-bold">Subscribe to get the latest updates</h6>
                    <p>Get latest updates from Church & Sermons straight to your inbox</p>
                    <form action="#" method="POST">
                        <div class="input-group">
                            <input type="email" class="form-control" name="subscribe" id="subscribe" placeholder="Email address">
                            <div class="input-group-append">
                                <button class="btn-custom btn" type="submit"><i class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-2 col-sm-12 col-xs-12">
                    <h6 class="text-custom-primary h5 font-weight-bold">Services</h6>
                    <h6><a href="{{ route('organisations.index')}}" class="text-custom-grey">Organisations</a></h6>
                    <h6><a href="{{ route('sermons.index') }}" class="text-custom-grey">Sermons</a></h6>
                    <h6><a href="{{ route('profiles.index') }}" class="text-custom-grey">Profiles</a></h6>
                </div>
                <div class="col-md-2 col-sm-12 col-xs-12">
                    <h6 class="text-custom-primary h5 font-weight-bold">About</h6>
                    <h6><a href="{{ route('about') }}" class="text-custom-grey">About Us</a></h6>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <h6 class="text-custom-primary h5 font-weight-bold">Contact Us</h6>
                    <p><a href="{{ route('contact') }}" class="text-custom-grey"><i class="fas fa-paper-plane text-white mr-1"></i> Send Message</a></p>
                    <p class="text-custom-grey"><i class="fas fa-phone text-white mr-1"></i> +(90) 0543 123 4567</p>
                    <p class="text-custom-grey"><i class="fas fa-envelope text-white mr-1"></i> info@churchandsermons.com</p>
                    <p class="text-custom-grey"><i class="fas fa-map-marker-alt text-white mr-1"></i> 349 Boyd Knolls East Demarcus, RI 13939-1050</p>
                </div>
            </div>
            <span class="border border-secondary d-block w-100 my-3"></span>
            <div class="d-md-flex justify-content-between flex-lg-row flex-sm-column">
                <p class="col-md-3 col-sm-12 col-xs-12">&copy;2019&nbsp;Church & Sermons</p>
                <p class="social-links col-md-5 text-md-center text-sm-center col-md-3 col-sm-12 col-xs-12">
                    <a href="#" class="text-custom-grey"><i class="fab fa-facebook-f mr-1"></i></a>
                    <a href="#" class="text-custom-grey"><i class="fab fa-twitter mr-1"></i></a>
                    <a href="#" class="text-custom-grey"><i class="fab fa-linkedin-in mr-1"></i></a>
                    <a href="#" class="text-custom-grey"><i class="fab fa-instagram mr-1"></i></a>
                </p>
                <p class="col-md-2 col-md-3 col-sm-12 col-xs-12"><a href="#" class="text-custom-grey">Terms of Service</a></p>
                <p class="col-md-2 col-md-3 col-sm-12 col-xs-12"><a href="#" class="text-custom-grey">Privacy Policy</a></p>
            </div>
        </div>
    </div>
</footer>
