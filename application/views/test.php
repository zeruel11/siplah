<?php isset($test)?var_dump($test):'' ?>
<?php isset($testing)?var_dump($testing):'' ?>
<?php $this->output->enable_profiler(TRUE); ?>
<?= CI_VERSION ?><br>
<!-- <?= time() ?><br> -->
<!-- <?= date('d-m-Y') ?> -->
<!-- <input class="btn btn-info btn-lg" name="notif" type="button" value="Shoow notif" onclick="notify"/> -->

<!-- <script>
	$.notify("I'm over here !");
</script> -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Validation Examples | Vindicate</title>
  <meta name="theme-color" content="#BA1D26"/>
</head>
<body id="index">

<header></header>

<!-- data-form-validation="format:email|name='Email Address'|required|active" -->

<!-- Goals:
 - Traverse the DOM as little as possible
 - Minimize code needed to activate complex validation
 - Allow custom validation types and functions
 -->

<main>
<div class="container">
  <div class="row">
    <div class="col-sm-4 push-sm-8">
      <nav>
        <ul class="nav nav-pills nav-fill">
          <li class="nav-item active"><a class="nav-link" href="#basic_validation">Basic Validation</a></li>
          <li class="nav-item active"><a class="nav-link" href="#active_validation">Active Validation</a></li>
        </ul>
      </nav>
    </div>
    <div class="col-sm-8 pull-sm-4">
      <div class="card">
        <div class="card-header">
          <h2 class="card-title">Basic Validation</h2>
        </div>
        <div class="card-block">
          <form id="basic_validation">
            <fieldset>
              <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="basic_full_name" class="form-control" placeholder="Your full name..." data-vindicate="required|format:alpha" />
              </div>
              <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="basic_phone_number" class="form-control" placeholder="(xxx) xxx-xxx" data-vindicate="required|format:phone" />
              </div>
              <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="basic_email" class="form-control" placeholder="xxxxxxxxx@xxxxx.com" data-vindicate="required|format:email" />
              </div>
              <div class="form-group">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" data-vindicate="required" /> I agree to the terms
                </label>
              </div>
              <button class="btn btn-primary btn-block" type="button" onclick="submitBasic()">Validate</button>
            </fieldset>
          </form>
        </div>
      </div>
      <br /><br />
      <div class="card">
        <div class="card-header">
          <h2 class="card-title">Basic Validation with Feedback</h2>
        </div>
        <div class="card-block">
          <form id="basicfeedback_validation">
            <fieldset>
              <div class="form-group">
                <label class="form-control-label">Full Name</label>
                <input type="text" name="active_full_name" class="form-control" placeholder="Your full name..." data-vindicate="required|format:alpha|min:6" />
                <small class="form-control-feedback"></small>
              </div>
              <div class="form-group">
                <label class="form-control-label">Phone Number</label>
                <input type="text" name="active_phone_number" class="form-control" placeholder="(xxx) xxx-xxx" data-vindicate="required|format:phone|active" />
                <small class="form-control-feedback"></small>
              </div>
              <div class="form-group">
                <label class="form-control-label">Email Address</label>
                <input type="text" name="active_email" class="form-control" placeholder="xxxxxxxxx@xxxxx.com" data-vindicate="required|format:email|active" />
                <small class="form-control-feedback"></small>
              </div>

              <div class="form-group">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadio1" value="option1" data-vindicate="required|group:radioOne"> Radio 1
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadio2" value="option1" data-vindicate="required|group:radioOne"> Radio 2
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadio3" value="option1" data-vindicate="required|group:radioOne"> Radio 3
                  </label>
                </div>
                <div><small class="form-control-feedback"></small></div>
              </div>

              <div class="form-group">
                <label class="form-control-label">Radio 2 details (required if Radio 2 selected)</label>
                <input type="text" name="active_radio2details" class="form-control" placeholder="..." data-vindicate="requiredField:optionsRadio2" />
                <small class="form-control-feedback"></small>
              </div>

              <div class="form-group">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" data-vindicate="required" /> I agree to the terms
                </label>
                <div><small class="form-control-feedback"></small></div>
              </div>
              <button class="btn btn-primary btn-block" type="button" onclick="submitBasicFeedback()">Validate</button>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</main>

<footer>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="<?= base_url('assets/js/vindicate.js') ?>"></script>

<script>
$("#basic_validation").vindicate("init");
$("#basicfeedback_validation").vindicate("init");

var submitBasic = function() {
  $("#basic_validation").vindicate("validate");
}

var submitBasicFeedback = function() {
  $("#basicfeedback_validation").vindicate("validate");
}
</script>

</body>

</html>
