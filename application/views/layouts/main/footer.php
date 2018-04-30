</main>

<footer>
    <section class="footer-top py-4 py-lg-5">
        <div class="container">
            <div class="row flex-column-reverse flex-md-row">
                <div class="col-md-5">

                    <h2 class="mb-3">More info</h2>
                    <div class="row">
                        <div class="col-lg-7">
                            <p class="mb-4 mb-lg-0">Integer pulvinar nulla vitae turpis luctus feugiat. Fusce efficitur enim nulla, vel euismod metus hendrerit ac. Integer tempor ornare ante quis venenatis. Vivamus quis feugiat magna. Quisque rhoncus cursus augue, id
                                vehicula leo volutpat nec. </p>
                        </div>
                        <div class="col-lg-5">
                            <ul class="footer-nav">
                                <li><a href="#">faq</a></li>
                                <li><a href="#">privacy policy</a></li>
                                <li><a href="#">about us</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-md-6 ml-auto">

                    <h2 class="mb-3">Contact Us</h2>
                    <form id="contact_email" class="contact-us mb-3 mb-md-0">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <textarea name="message" class="form-control" placeholder="Message" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group m-0">
                                    <input type="submit" name="email" class="btn btn-dark" placeholder="Email" value="Submit">
                                </div>
                            </div>
                        </div>
                    </form>

                    <script>
                        $(document).ready(function () {
                            //add comments
                            general_ajax_call('form#contact_email', 'email/send_contact_email');
                        });
                    </script>

                </div>
            </div>
        </div>
    </section>

    <section class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="footer-bottom__wrapper py-3 p-md-0">

                        <p class="footer-brand mb-2 mb-md-0">betDANGER!<sup>&copy;</sup></p>

                        <ul class="social_icons">
                            <li>
                                <a href="#" class="facebook" target="_blank">
                                    <span class="icon-facebook"></span>
                                    <p>Facebook</p>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="twitter" target="_blank">
                                    <span class="icon-twitter"></span>
                                    <p>Twitter</p>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="pinterest" target="_blank">
                                    <span class="icon-pinterest"></span>
                                    <p>Pinterest</p>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="instagram" target="_blank">
                                    <span class="icon-instagram"></span>
                                    <p>Instagram</p>
                                </a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </section>
</footer>
