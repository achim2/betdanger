<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8 mx-auto my-5">

            <h2>Contact Us</h2>
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
                        <div class="form-group">
                            <input type="submit" name="email" class="btn btn-dark" placeholder="Email" value="Submit">
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        //ajax contact email send
        general_ajax_call('form#contact_email', '/email/send_contact_email');
    });
</script>