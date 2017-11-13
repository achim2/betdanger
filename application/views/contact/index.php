<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mx-auto">

            <main>
                <h2 class="section-name">Contact Us</h2>
                <section class="contact">

                    <p>In magna metus, efficitur in luctus ut, maximus nec erat. Suspendisse nec iaculis justo. Etiam hendrerit enim eros, eget convallis magna maximus vel. Mauris turpis ac maximus lacinia. Fusce in bibendum felis. Morbi
                        pulvinar efficitur. Quisque vel eros et mauris imperdiet elementum sit amet a felis. Donec purus nec purus posuere dapibus. Fusce ac maximus augue. Phasellus lobortis dapibus diam id rutrum. Sed ac egestas
                        metus, id congue massa.
                    </p>

                    <form id="contact_email">
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

                </section>
            </main>

        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        //ajax contact email send
        general_ajax_call('form#contact_email', '/email/send_contact_email');
    });
</script>