<div class="container px-4 py-5 mx-auto">
    <div class="card card0">
        <div class="d-flex flex-lg-row flex-column-reverse">
            <div class="card card1">
                <div class="row justify-content-center my-auto">
                    <div class="col-md-8 col-10 my-5">
                        <h3 class="mb-5 text-center heading">Codarel</h3>
                        <h6 class="msg-info">Register</h6>
                        <form action="<?= BASEURL; ?>/auth/create" method="POST">
                            <div class="form-group">
                                <label class="form-control-label text-muted" for="email">Email</label>
                                <input type="email" id="email" name="email" placeholder="Email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label text-muted" for="password">Password</label>
                                <input type="password" id="password" name="password" placeholder="Password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label text-muted" for="confirm">Confirm Password</label>
                                <input type="password" id="confirm" name="confirm" placeholder="Confirm Password" class="form-control">
                            </div>
                            <div class="row justify-content-center my-3 px-3">
                                <button class="btn-block btn-color">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="bottom text-center mb-5">
                    <p class="sm-text mx-auto mb-3">Have an account?
                        <a href="<?= BASEURL; ?>auth" class="btn btn-white ml-2">Login</a>
                    </p>
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