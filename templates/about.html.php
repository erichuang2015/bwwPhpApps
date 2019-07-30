<link rel="stylesheet" href="/css/about.css">
<!--hidden input to store the current language selection.  It is read by layout.js-->
<input id="language" type="hidden" value="<?= $language?>">
<div class="jumbotron">
    <div class="container">
        <h1 class="display-3"><?= $content['h1Text'] ?></h1>
    </div>
</div>
<div class="container fill-height">
    <div class="card mb-5">
        <img src="/css/images/markus-spiske-xekxE_VR0Ec-unsplash.jpg" class="img-fluid" alt="<?= $content['codePicAltTxt'] ?>">
        <a style="background-color:black;color:white;text-decoration:none;padding:4px 6px;font-family:-apple-system, BlinkMacSystemFont, &quot;San Francisco&quot;, &quot;Helvetica Neue&quot;, Helvetica, Ubuntu, Roboto, Noto, &quot;Segoe UI&quot;, Arial, sans-serif;font-size:12px;font-weight:bold;line-height:1.2;display:inline-block;border-radius:3px"
           href="https://unsplash.com/@markusspiske?utm_medium=referral&amp;utm_campaign=photographer-credit&amp;utm_content=creditBadge" target="_blank" rel="noopener noreferrer" title="<?= $content['codePicCitation'] ?>"><span style="display:inline-block;padding:2px 3px"><svg
                        xmlns="http://www.w3.org/2000/svg" style="height:12px;width:auto;position:relative;vertical-align:middle;top:-2px;fill:white" viewBox="0 0 32 32"><title>unsplash-logo</title><path d="M10 9V0h12v9H10zm12 5h10v18H0V14h10v9h12v-9z"></path></svg></span><span style="display:inline-block;padding:2px 3px">Markus Spiske</span></a>
        <div class="card-body">
            <h5 class="card-title"><?= $content['headingTechsUsed'] ?></h5>
            <p class="card-text"><?= $content['belowListTechs'] ?></p>
            <dl>
                <dt><a href="https://www.vagrantup.com/" target="_blank">Vagrant</a></dt>
                <dd><?= $content['vagrantUsage'] ?></dd>
                <dt><a href="https://github.com/Swader/homestead_improved" target="_blank">Homestead Improved</a></dt>
                <dd><?= $content['homesteadUsage'] ?></dd>
                <dt><a href="https://www.virtualbox.org/" target="_blank">Virtual Box</a></dt>
                <dd><?= $content['virtualBoxUsage'] ?></dd>
                <dt><a href="https://www.php.net/" target="_blank">PHP7.3</a></dt>
                <dd><?= $content['phpUsage'] ?></dd>
                <dt><a href="https://www.mysql.com/" target="_blank">MySQL</a></dt>
                <dd><?= $content['mysqlUsage'] ?></dd>
                <dt><a href="https://www.ecma-international.org/ecma-262/6.0/" target="_blank">JavaScript ECMA6</a></dt>
                <dd><?= $content['jsUsage'] ?></dd>
                <dt><a href="https://jquery.com/" target="_blank">jQuery</a></dt>
                <dd><?= $content['jQueryUsage'] ?></dd>
                <dt><a href="https://gijgo.com/datepicker" target="_blank">GIJGO</a></dt>
                <dd><?= $content['gijgoUsage'] ?></dd>
                <dt><a href="https://www.w3.org/TR/CSS/#css" target="_blank">CSS3</a></dt>
                <dd><?= $content['cssUsage'] ?></dd>
                <dt><a href="https://www.w3.org/TR/2017/REC-html52-20171214/" target="_blank">HTML5</a></dt>
                <dd><?= $content['htmlUsage'] ?></dd>
                <dt><a href="https://getbootstrap.com/" target="_blank">Bootstrap 4</a></dt>
                <dd><?= $content['bootstrapUsage'] ?></dd>
                <dt><a href="https://git-scm.com/" target="_blank">Git</a></dt>
                <dd><?= $content['gitUsage'] ?></dd>
                <dt><a href="https://github.com/PHPMailer/PHPMailer" target="_blank">PHPMailer</a></dt>
                <dd><?= $content['phpMailerUsage'] ?></dd>
                <dt><a href="https://fontawesome.com/" target="_blank">Font Awesome</a></dt>
                <dd><?= $content['fontAwesomeUsage'] ?></dd>
                <dt><a href="https://fontawesome.com/" target="_blank">Open Iconic</a></dt>
                <dd><?= $content['openIconicUsage'] ?></dd>
            </dl>
            <p class="lead font-weight-bold"><?= $content['sourceCodeReference'] ?></p>
        </div>
    </div>
    <div class="card">
        <img src="/css/images/ross-findon-mG28olYFgHI-unsplash.jpg" class="img-fluid" alt="<?= $content['changeImgAltTxt'] ?>">
        <a style="background-color:black;color:white;text-decoration:none;padding:4px 6px;font-family:-apple-system, BlinkMacSystemFont, &quot;San Francisco&quot;, &quot;Helvetica Neue&quot;, Helvetica, Ubuntu, Roboto, Noto, &quot;Segoe UI&quot;, Arial, sans-serif;font-size:12px;font-weight:bold;line-height:1.2;display:inline-block;border-radius:3px"
           href="https://unsplash.com/@rossf?utm_medium=referral&amp;utm_campaign=photographer-credit&amp;utm_content=creditBadge" target="_blank" rel="noopener noreferrer" title="Download free do whatever you want high-resolution photos from Ross Findon"><span style="display:inline-block;padding:2px 3px"><svg
                        xmlns="http://www.w3.org/2000/svg" style="height:12px;width:auto;position:relative;vertical-align:middle;top:-2px;fill:white" viewBox="0 0 32 32"><title>unsplash-logo</title><path d="M10 9V0h12v9H10zm12 5h10v18H0V14h10v9h12v-9z"></path></svg></span><span style="display:inline-block;padding:2px 3px">Ross Findon</span></a>
        <div class="card-body">
            <h5 class="card-title"><?= $content['headingFutureUpdates'] ?></h5>
            <p class="card-text"><?= $content['belowListUpdates'] ?></p>
            <dl>
                <dt><?= $content['spanishUpdate'] ?></dt>
                <dd><?= $content['spanishDescription'] ?></dd>
                <dt><?= $content['helpUpdate'] ?></dt>
                <dd><?= $content['helpDescription'] ?></dd>
                <dt><?= $content['s508Update'] ?></dt>
                <dd><?= $content['s508Description'] ?></dd>
                <dt><?= $content['seoUpdate'] ?></dt>
                <dd><?= $content['seoDescription'] ?></dd>
            </dl>
        </div>
    </div>
    <div class="card">
        <img src="/css/images/bworsham_profile.png" class="img-fluid" alt="<?= $content['devPicAltTxt'] ?>">
        <div class="card-body">
            <h5 class="card-title"><?= $content['siteDev'] ?></h5>
            <span class="font-weight-bold">Brian Worsham</span>
            <h6 class="font-italic"><?= $content['devbackgroundTxt'] ?></h6>
            <p class="card-text"><?= $content['devDiscreption'] ?></p>
            <p class="card-text"><?= $content['devDiscreption2'] ?></p>
            <div class="row mb-3">
                <div class="col-6">
                    <span class="font-weight-bold d-block"><?= $content['work'] ?></span>
                    <span class="card-text"><small>CGI Federal</small></span>
                </div>
                <div class="col-6">
                    <span class="font-weight-bold card-text d-block"><?= $content['education'] ?></span>
                    <span class="card-text"><small>Texas A&M University–Central Texas</small></span>
                </div>
            </div>
            <a href="https://www.linkedin.com/in/brian-w-worsham/" target="_blank" class="bg-primary text-white px-1"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </div>

</div>
</div>
<!--<script type="text/javascript" src="/js/about.js"></script>-->