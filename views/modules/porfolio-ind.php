    <?php include("cabecera.php"); ?>

    <!-- START SECTION TOP -->
    <section class="section-top" style="background-image: url(views/assets/img/bg/section-top.png);background-size:cover; background-position: center center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                <div class="section-top-title">
                    <h1>SIngle Project Details</h1>		
                </div>
                </div><!--- END COL -->				  
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END SECTION TOP -->

    <!-- START PORTFOLIO SINGLE PROJECT -->
    <section class="single_project_area section-padding">	
        <div class="container">
            <div class="row project_dec">
                <div class="col-lg-6 col-sm-12 col-xs-12">
                    <div class="media-left">
                        <img src="views/assets/img/portfolio/2.jpg" class="img-fluid" alt="portfolio-image" />		
                    </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-xs-12">
                        <div class="project_details">
                            <div class="about_project">
                                <h4>About Project</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore. Lorem ipsum dolor sit amet.</p>
                            </div>
                            <div class="about_project_details">
                                <ul>
                                    <li><i class="fa fa-user"></i><b>Client: </b>Google, Inc</li>
                                    <li><i class="fa fa-clock-o"></i><b>Date: </b>01 Sep, 2026</li>
                                    <li><i class="fa fa-folder"></i><b>Category: </b><a href="#">Web Design</a></li>
                                    <li><i class="fa fa-folder"></i><b>Project Url: </b><a href="#">www.google.com</a></li>
                                </ul>
                            </div>
                            <a class="btn_one" href="#">See Live Project</a>
                        </div>
                    </div><!--- END COL -->
            </div><!--- END ROW -->
            <div class="row project_dec">
                <div class="col-lg-6 col-sm-12 col-xs-12">
                    <div class="media-left">
                        <img src="views/assets/img/portfolio/2.jpg" class="img-fluid" alt="portfolio-image" />		
                    </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-xs-12">
                        <div class="project_details">
                            <div class="about_project">
                                <h4>About Project</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore. Lorem ipsum dolor sit amet.</p>
                            </div>
                            <div class="about_project_details">
                                <ul>
                                    <li><i class="fa fa-user"></i><b>Client: </b>Google, Inc</li>
                                    <li><i class="fa fa-clock-o"></i><b>Date: </b>02 Sep, 2026</li>
                                    <li><i class="fa fa-folder"></i><b>Category: </b><a href="#">Web Design</a></li>
                                    <li><i class="fa fa-folder"></i><b>Project Url: </b><a href="#">www.google.com</a></li>
                                </ul>
                            </div>
                            <a class="btn_one" href="#">See Live Project</a>
                        </div>
                    </div><!--- END COL -->
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </section>	
    <!-- END PORTFOLIO SINGLE PROJECT -->

    <!-- CONTACT -->
    <div id="contact" class="contact_area section-padding">
        <div class="container">
            <div class="section-title text-center">
                <h2 class="section-title-white">Get in touch.</h2>
                <p class="section-title-white">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
            </div>				
            <div class="row">					
                <div class="offset-lg-1 col-lg-10 col-sm-12 col-xs-12 text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
                    <div class="contact">
                        <form class="form" name="enq" method="post" action="contact.php" onsubmit="return validation();">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Name" required="required">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="email" name="email" class="form-control" placeholder="Email" required="required">
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="text" name="subject" class="form-control" placeholder="Subject" required="required">
                                </div>
                                <div class="form-group col-md-12">
                                    <textarea rows="6" name="message" class="form-control" placeholder="Type your message that on your mind..." required="required"></textarea>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" value="Send message" name="submit" id="submitButton" class="contact_btn" title="Submit Your Message!">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- END COL  -->					
            </div><!-- END ROW -->				
        </div><!--- END CONTAINER -->
    </div>
<!-- END CONTACT -->		
