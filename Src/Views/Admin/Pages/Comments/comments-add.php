<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
          
                <?php
                if (isset($_SESSION['Comment']['error'])) :
                ?>
                    <div class="alert alert-danger mt-5" role="alert">
                        <?= $_SESSION['Comment']['error'] ?>
                    </div>
                <?php
                    unset($_SESSION['Comment']);
                endif;
                ?>
                <?php
                if (isset($_SESSION['Comment']['success'])) :
                ?>
                    <div class="alert alert-success mt-5" role="alert">
                        <?= $_SESSION['Comment']['success'] ?>
                    </div>
                <?php
                    unset($_SESSION['Comment']['success']);
                endif;
                ?>

                <?php
                if (isset($_SESSION['Comment']['failDelete'])) :
                ?>
                    <div class="alert alert-danger mt-5" role="alert">
                        <?= $_SESSION['Comment']['failDelete'] ?>
                    </div>
                <?php
                    unset($_SESSION['Comment']);
                endif;
                ?>

                <?php
                if (isset($_SESSION['Comment']['successDelete'])) :
                ?>
                    <div class="alert alert-success mt-5" role="alert">
                        <?= $_SESSION['Comment']['successDelete'] ?>
                    </div>
                <?php
                    unset($_SESSION['Comment']);
                endif;
                ?>
            </form>
        </div>
    </div>
</div>