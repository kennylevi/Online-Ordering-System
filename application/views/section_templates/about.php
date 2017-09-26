 <section id="About" class="nav-section">
        <div class="container about-title">
            <h3>Who We Are</h3>
        </div>
        <div class="container about-wrapper">
            <div class="row">
                <?php foreach ($about as $about_content): ?>
                <div class="col-md-5">
                    <div class="img-wrap">
                        <img class="img-responsive" src="<?php echo site_url($about_content->image);?>">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="description">
                      <p><?php echo $about_content->content; ?></p>
                    </div>
                </div>
                <?php endforeach; ?> 
            </div>
        </div>
      </section>