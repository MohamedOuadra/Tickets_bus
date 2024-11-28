<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Register Here</title>
    <!-- Add your CSS and JS files here -->
    <!-- Site favicon -->
    <link
        rel="apple-touch-icon"
        sizes="180x180"
        href="<?= base_url('vendors/images/apple-touch-icon.png') ?>"
    />
    <link
        rel="icon"
        type="image/png"
        sizes="32x32"
        href="<?= base_url('vendors/images/favicon-32x32.png') ?>"
    />
    <link
        rel="icon"
        type="image/png"
        sizes="16x16"
        href="<?= base_url('vendors/images/favicon-16x16.png') ?>"
    />

    <!-- Mobile Specific Metas -->
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1"
    />

    <!-- Google Font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet"
    />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('vendors/styles/core.css') ?>" />
    <link
        rel="stylesheet"
        type="text/css"
        href="<?= base_url('vendors/styles/icon-font.min.css') ?>"
    />
    <link
        rel="stylesheet"
        type="text/css"
        href="<?= base_url('src/plugins/jquery-steps/jquery.steps.css') ?>"
    />
    <link rel="stylesheet" type="text/css" href="<?= base_url('vendors/styles/style.css') ?>" />
</head>
<body class="login-page">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="login.html">
                    <img style="height: 118%;" src="<?= base_url('vendors/images/bus/final_logo.png') ?>" alt="" />
                </a>
            </div>
            <div class="login-menu">
                <ul>
                    <li><a href="<?= site_url('auth/login') ?>">Login</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="register-page-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="<?= base_url('vendors/images/bus/register.png') ?>" alt="" />
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="register-box py-3 px-5 bg-white box-shadow border-radius-10">
                        <div class="wizard-content">
                            <form
                                id="registerForm"
                                action="<?= site_url('auth/register') ?>"
                                method="post"
                            >
                                <?= csrf_field() ?>
                                <div class="login-title">
                                    <h4 class="text-center text-primary">Register To Amoudou</h4><br>
                                </div>
                                <section>
                                    <div class="form-wrap max-width-600 mx-auto">
                                        <!-- Nom -->
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">First Name*</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nom_client" class="form-control" value="<?= old('nom_client') ?>" required />
                                                <?php if (session()->getFlashdata('validation') && isset(session()->getFlashdata('validation')['nom_client'])): ?>
                                                    <div class="error-text text-danger" style="font-size: 0.9rem;">
                                                        <?= session()->getFlashdata('validation')['nom_client'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <!-- Prénom -->
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Last Name*</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="prenom_client" class="form-control" value="<?= old('prenom_client') ?>" required />
                                                <?php if (session()->getFlashdata('validation') && isset(session()->getFlashdata('validation')['prenom_client'])): ?>
                                                    <div class="error-text text-danger" style="font-size: 0.9rem;">
                                                        <?= session()->getFlashdata('validation')['prenom_client'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Email Address*</label>
                                            <div class="col-sm-8">
                                                <input type="email" name="email_client" class="form-control" value="<?= old('email_client') ?>" required />
                                                <?php if (session()->getFlashdata('validation') && isset(session()->getFlashdata('validation')['email_client'])): ?>
                                                    <div class="error-text text-danger" style="font-size: 0.9rem;">
                                                        <?= session()->getFlashdata('validation')['email_client'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <!-- Téléphone -->
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Phone Number*</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="telephone_client" class="form-control" value="<?= old('telephone_client') ?>" required />
                                                <?php if (session()->getFlashdata('validation') && isset(session()->getFlashdata('validation')['telephone_client'])): ?>
                                                    <div class="error-text text-danger" style="font-size: 0.9rem;">
                                                        <?= session()->getFlashdata('validation')['telephone_client'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <!-- Mot de passe -->
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Password*</label>
                                            <div class="col-sm-8">
                                                <input type="password" name="mot_de_passe" class="form-control" required />
                                                <?php if (session()->getFlashdata('validation') && isset(session()->getFlashdata('validation')['mot_de_passe'])): ?>
                                                    <div class="error-text text-danger" style="font-size: 0.9rem;">
                                                        <?= session()->getFlashdata('validation')['mot_de_passe'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <!-- Confirmer le mot de passe -->
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Confirm Password*</label>
                                            <div class="col-sm-8">
                                                <input type="password" name="confirm_password" class="form-control" required />
                                                <?php if (session()->getFlashdata('validation') && isset(session()->getFlashdata('validation')['confirm_password'])): ?>
                                                    <div class="error-text text-danger" style="font-size: 0.9rem;">
                                                        <?= session()->getFlashdata('validation')['confirm_password'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <!-- Submit Button -->
                                <div class="form-group d-flex">
                                    <button type="submit" class="btn btn-primary btn-lg mt-3 ml-auto">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="<?= base_url('vendors/scripts/core.js') ?>"></script>
</body>
</html>
