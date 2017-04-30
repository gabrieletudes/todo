<div class="container">
    <h1>Qui êtes-vous ?</h1>
    <form class="col s12 m12 l6" action="index.php"
          method="post">
        <fieldset>
            <legend>Vos infos</legend>
            <div class="row">
            <div class="input-field col s12">
                <input type="text" id="email" name="email">
                <label for="email" class="active">Votre email</label>
            </div>
            </div>
            <div class="row">
            <div class="input-field col s12">
                <input type="password" id="password" name="password">
                <label for="password" class="active">Votre mot de passe</label>
            </div>
            </div>
            <input type="hidden" name="a" value="postLogin">
            <input type="hidden" name="r" value="auth">

            <div class="input-field col s12">
                <input type="submit" value="vérifier" class="btn waves-effect waves-light">
            </div>
        </fieldset>
    </form>
</div>
