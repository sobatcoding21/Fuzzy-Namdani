<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
        <div class="">
            <div class="main-menu-header">
                <img class="img-80 img-radius" src="<?= base_url() ?>assets/images/logo-bpbd-kediri.png" alt="User-Profile-Image">
                <div class="user-details">
                    <span id="more-details">Admin<i class="fa fa-caret-down"></i></span>
                </div>
            </div>

            <div class="main-menu-content">
                
            </div>
        </div>
        <div class="p-15 p-b-0">
            <form class="form-material">
                <div class="form-group form-primary">
                    <input type="text" name="footer-email" class="form-control" required="">
                    <span class="form-bar"></span>
                    <label class="float-label"><i class="fa fa-search m-r-10"></i>Search Friend</label>
                </div>
            </form>
        </div>
        <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Dashboard</div>
        <ul class="pcoded-item pcoded-left-item">
            <li <?= $this->uri->uri_string == "" ? 'class="active"' : '' ?>>
                <a href="<?= base_url() ?>" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Data Bencana Hidrometeorologi</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li <?= $this->uri->uri_string == "fuzzy-mamdani" ? 'class="active"' : '' ?>  >
                <a href="<?= base_url('fuzzy-mamdani') ?>" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-agenda"></i><b>D</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Data Fuzzy Mamdani</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li <?= $this->uri->uri_string == "peta" ? 'class="active"' : '' ?> >
                <a href="<?= base_url('peta') ?>" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-map-alt"></i><b>D</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Peta</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li <?= $this->uri->uri_string == "peringatan-dini" ? 'class="active"' : '' ?> >
                <a href="<?= base_url('peringatan-dini') ?>" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-alarm-clock"></i><b>D</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Peringatan Dini</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li >
                <a href="<?= base_url('logout') ?>" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-lock"></i><b>D</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Log out</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
        
    </div>
</nav>