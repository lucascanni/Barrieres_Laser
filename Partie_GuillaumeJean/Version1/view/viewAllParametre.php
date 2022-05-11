<?php
ob_start();
$title = "Liste Parametres";
?>

<script type="text/javascript">
        // On stocke la valeur de modification
        var modif;
        var ciblage;

        function attribution(id) {
                        ciblage=id;
                }

        $(function() {

                


                // On cache les elements que l'on ne veux pas voir
                $(".input").hide();
                $(".save").hide();
                $(".cancel").hide();

                //qd on clique sur modifier
                $(".update").click(function() {
                        // On inverse la vue des éléments
                        $("#entree"+ciblage).show();
                        $("#enregistrer"+ciblage).show();
                        $("#annuler"+ciblage).show();
                        $("#modifier"+ciblage).hide();
                        $("#donnee"+ciblage).hide();

                        $(".cancel").click(function() {
                                $("#entree"+ciblage).hide();
                                $("#enregistrer"+ciblage).hide();
                                $("#annuler"+ciblage).hide();
                                $("#modifier"+ciblage).show();
                                $("#donnee"+ciblage).show();
                        });

                        //qd on clique sur enregister
                        $("#enregistrer").click(function() {
                                // on save la valeur de la modif
                                modif = $('#input1').val();

                                // on fait une requete ajax qui appelle un script php et dans lequel on envoie modif
                                $.ajax({

                                        type: "POST",
                                        url: "tmp.php",
                                        data: {
                                                "modif": modif
                                        },
                                        datatype: "json",
                                        success: handleData,
                                        error: function(resultat, statut, erreur) {
                                                alert("error;" + erreur);
                                        }
                                });
                        });
                });

                // function qui s'occupe de la reponse a la requete
                function handleData(jsonDatas) {
                        if (jsonDatas.response == "OK") {
                                $("#divID2").hide();
                                $("#button2").hide();
                                $("#h11").replaceWith('<h1 id= "h11">' + modif + '</h1>');
                                $("#divID1").show();
                                $("#button1").show();
                        }
                }
        });
</script>

<h1><?= $titre ?></h1>

<div class="data">
        <img id="background_default_bis" src=<?= Router::makeURL("public/img/cerema_responsive.jpg") ?> alt="">
        <?php
        foreach ($data as $laData) : ?>

                <div class="contenu">

                        <div class="datas">
                                <h4 id="donnee1" class="donnee">Distance inter-barrière : <?= $laData->getDistanceBarrieres() ?>m </h4>
                                <input type="text" id="entree1" class="input"></input>
                                <button type="button" onclick="attribution('1');" id="modifier1" class="update"><i class="fas fa-pen"></i></button>
                                <button type="button" id="enregistrer1" class="save">Enregistrer</button>
                                <button type="button" id="annuler1" class="cancel">cancel</button><br>
                        </div>

                        <div class="datas">
                                <h4 id="donnee2" class="donnee">Chemin repertoire image : <?= $laData->getRepertoireImages() ?> </h4>
                                <input type="text" id="input" class="input"></input>
                                <button type="button" id="modifier" class="update"><i class="fas fa-pen"></i></button>
                                <button type="button" id="enregistrer" class="save">Enregistrer</button>
                                <button type="button" id="cancel" class="cancel">cancel</button><br>
                        </div>

                        <div class="datas">
                                <h4 id="donnee3" class="donnee">IP du serveur : <?= $laData->getipServeur() ?> </h4>
                                <input type="text" id="input1" class="input"></input>
                                <button type="button" id="modifier" class="update"><i class="fas fa-pen"></i></button>
                                <button type="button" id="enregistrer" class="save">Enregistrer</button>
                                <button type="button" id="cancel" class="cancel">cancel</button><br>
                        </div>

                        <div class="datas">
                                <h4 id="donnee4" class="donnee">IP caméra 1 : <?= $laData->getipCam1() ?> </h4>
                                <input type="text" id="input1" class="input"></input>
                                <button type="button" id="modifier" class="update"><i class="fas fa-pen"></i></button>
                                <button type="button" id="enregistrer" class="save">Enregistrer</button>
                                <button type="button" id="cancel" class="cancel">cancel</button><br>
                        </div>

                        <div class="datas">
                                <h4 id="donnee5" class="donnee">IP caméra 2 : <?= $laData->getipCam2() ?> </h4>
                                <input type="text" id="input1" class="input"></input>
                                <button type="button" id="modifier" class="update"><i class="fas fa-pen"></i></button>
                                <button type="button" id="enregistrer" class="save">Enregistrer</button>
                                <button type="button" id="cancel" class="cancel">cancel</button><br>
                        </div>

                        <div class="datas">
                                <h4 id="donnee6" class="donnee">IP module d'acquisition : <?= $laData->getipESP() ?> </h4>
                                <input type="text" id="input1" class="input"></input>
                                <button type="button" id="modifier" class="update"><i class="fas fa-pen"></i></button>
                                <button type="button" id="enregistrer" class="save">Enregistrer</button>
                                <button type="button" id="cancel" class="cancel">cancel</button><br>
                        </div>

                        <div class="datas">
                                <h4 id="donnee7" class="donnee">SSID wifi : <?= $laData->getWifi_SSID() ?> </h4>
                                <input type="text" id="input1" class="input"></input>
                                <button type="button" id="modifier" class="update"><i class="fas fa-pen"></i></button>
                                <button type="button" id="enregistrer" class="save">Enregistrer</button>
                                <button type="button" id="cancel" class="cancel">cancel</button><br>
                        </div>

                        <div class="datas">
                                <h4 id="donnee1" class="donnee">Clé wifi : <?= $laData->getWifi_KEY() ?> </h4>
                                <input type="text" id="input1" class="input"></input>
                                <button type="button" id="modifier" class="update"><i class="fas fa-pen"></i></button>
                                <button type="button" id="enregistrer" class="save">Enregistrer</button>
                                <button type="button" id="cancel" class="cancel">cancel</button><br>
                        </div>

                        <div class="datas">
                                <h4 id="donnee8" class="donnee">Niveau de batterie : <?= $laData->getNiveauBatterie() ?>% </h4>
                                <input type="text" id="input1" class="input"></input>
                                <button type="button" id="modifier" class="update"><i class="fas fa-pen"></i></button>
                                <button type="button" id="enregistrer" class="save">Enregistrer</button>
                                <button type="button" id="cancel" class="cancel">cancel</button><br>
                        </div>

                </div>

        <?php endforeach; ?>
</div>

<?php
$content = ob_get_clean();
require('template.php');
