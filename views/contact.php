    <div class="container contact-form" style="font-family: 'IBM Plex Sans', sans-serif;">
        <div class="contact-image">
            <img src="https://image.ibb.co/kUagtU/rocket_contact.png" alt="rocket_contact"/>
        </div>
        <form method="post" action="contact.php">
            <h3>Drop Us a Message</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="txtName" class="form-control" placeholder="Your Name *" value="" onkeydown="return alphaOnly(event);" required/>
                    </div>
                    <div class="form-group">
                        <input type="email" name="txtEmail" class="form-control" placeholder="Your Email *" value="" required />
                    </div>
                    <div class="form-group">
                        <input type="tel" name="txtPhone" class="form-control" placeholder="Your Phone Number *" value="" minlength="10" maxlength="10" required />
                    </div>
                    <div class="form-group" >
                        <input type="submit" name="btnSubmit" class="btnContact"   value="Send Message" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" >
                        <textarea name="txtMsg" class="form-control" placeholder="Your Message *" style="width: 100%; height: 150px;" required></textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
