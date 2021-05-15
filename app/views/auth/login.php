<div class="container px-4 py-5 mx-auto">
    <div class="card card0">
        <div class="d-flex flex-lg-row flex-column-reverse">
            <div class="card card1">
                <div class="row justify-content-center my-auto">
                    <div class="col-md-8 col-10 my-5">
                        <h3 class="mb-5 text-center heading">Codarel</h3>
                        <div class="row">
                            <div class="col-lg-12">
                                <?php Flasher::flash(); ?>
                            </div>
                        </div>
                        <h6 class="msg-info">Please login to your account</h6>
                        <form action="<?= BASEURL; ?>auth/login" method="POST">
                            <div class="form-group"> <label class="form-control-label text-muted">Email</label>
                                <input type="email" id="email" name="email" placeholder="Email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label text-muted">Password</label>
                                <input type="password" id="password" name="password" placeholder="Password" class="form-control">
                            </div>
                            <div class="row justify-content-center my-3 px-3">
                                <button class="btn-block btn-color">Login</button>
                            </div>
                        </form>
                        <div class="row justify-content-center my-2">
                            <a href="#"><small class="text-muted">Forgot Password?</small></a>
                        </div>
                    </div>
                </div>
                <div class="bottom text-center mb-5">
                    <p href="#" class="sm-text mx-auto mb-3">Don't have an account?<a href="<?= BASEURL; ?>auth/register" class="btn btn-white ml-2">Create new</a></p>
                </div>
            </div>
            <div class="card card2">
                <div class="my-auto mx-md-5 px-md-5 right">
                    <h3 class="text-white">We are more than just a company</h3> <small class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</small>
                </div>
            </div>
        </div>
    </div>
</div>