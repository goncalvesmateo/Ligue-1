<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="script/formscript.js"></script>
        <link rel="stylesheet" type="text/css" href="../style/style.css">
    </head>
    <body>
        <br>
        <form method="post" action="/inscription" enctype="multipart/form-data">
            <div>
                <h2>Inscription</h2>
                <div class="formulaire">
                    <input type="text" id="nom" name="nom" placeholder="Nom" required>
                </div>
                <div class="formulaire">
                    <input type="text" id="prenom" name="prenom" placeholder="Prénom" required>
                </div>
                <div class="formulaire">
                    <input type="email" id="mail" name="mail" placeholder="Courriel" required>
                </div>
                <div class="formulaire">
                    <input type="text" id="mdp" name="mdp" placeholder="Mot de passe" required>
                </div>
                <div class="formulaire">
                    <input type="text" id="codepostal" name="codepostal" placeholder="Code Postal" oninput="listerCommunes()" required>
                </div>

                <div class="formulaire">
                    <select class="list" id="list" name="list">
                        <script>
                            function listerCommunes() {
                                var codepostal = document.getElementById("codepostal").value;

                                var xhr = new XMLHttpRequest();
                                xhr.responseType = 'json';
                                xhr.open('GET', "https://geo.api.gouv.fr/communes?codePostal=" + codepostal);
                                xhr.send();

                                xhr.onload = function () {
                                    var communeJSON = xhr.response;
                                    var selectElement = document.getElementById("list");
                                    selectElement.innerHTML = ""; // Effacer les options existantes avant de mettre à jour
                                    for (var i = 0; i < communeJSON.length; i++) {
                                        var optionElement = document.createElement("option");
                                        optionElement.textContent = communeJSON[i]["nom"];
                                        selectElement.appendChild(optionElement);
                                    }
                                };
                            }
                        </script>
                    </select>
                </div>

                <div class="formulaire">
                    <select class="list" id="list" name="list">
                        <?php
                            require_once('model/dbconnect.php');

                            $query = "SELECT id_club, nom_club FROM club";
                            $result = $pdo->query($query);
                            
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value=\"" . $row['id_club'] . "\">" . $row['nom_club'] . "</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>

            <h2>Sexe</h2>
            <div class="bouton-radio">            
                <input type="radio" id="sexe" name="sexe" value="Homme" />
                <label for="homme">Homme</label>
            
                <input type="radio" id="sexe" name="sexe" value="Femme" />
                <label for="femme">Femme</label>
            
                <input type="radio" id="sexe" name="sexe" value="Autre" />
                <label for="autre">Autre</label>
            </div>
            
            <h2>Photo de profil</h2>
            <div class="img_select">
                <input type="file" accept="image/*" name="image" id="image" onchange="displayImage(event)">
                <br><br>
                <img id="preview" src="#" alt="Image Preview" style="max-width: 300px; max-height: 300px;">
                <br><br>
            </div>
            
            <div id="teachable-model-container">
                <div>Teachable Machine Image Model</div>
                    <button type="button" onclick="init()">Start</button>
                    <div id="webcam-container"></div>
                    <div id="label-container"></div>
                    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest/dist/tf.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@latest/dist/teachablemachine-image.min.js"></script>
                    <script type="text/javascript">
                        // More API functions here:
                        // https://github.com/googlecreativelab/teachablemachine-community/tree/master/libraries/image

                        // the link to your model provided by Teachable Machine export panel
                        const URL = "../model/";

                        let model, webcam, labelContainer, maxPredictions;

                        // Load the image model and setup the webcam
                        async function init() {
                            const modelURL = URL + "model.json";
                            const metadataURL = URL + "metadata.json";

                            // load the model and metadata
                            // Refer to tmImage.loadFromFiles() in the API to support files from a file picker
                            // or files from your local hard drive
                            // Note: the pose library adds "tmImage" object to your window (window.tmImage)
                            model = await tmImage.load(modelURL, metadataURL);
                            maxPredictions = model.getTotalClasses();

                            // Convenience function to setup a webcam
                            const flip = true; // whether to flip the webcam
                            webcam = new tmImage.Webcam(200, 200, flip); // width, height, flip
                            await webcam.setup(); // request access to the webcam
                            await webcam.play();
                            window.requestAnimationFrame(loop);

                            // append elements to the DOM
                            document.getElementById("webcam-container").appendChild(webcam.canvas);
                            labelContainer = document.getElementById("label-container");
                            for (let i = 0; i < maxPredictions; i++) { // and class labels
                                labelContainer.appendChild(document.createElement("div"));
                            }
                        }

                        async function loop() {
                            webcam.update(); // update the webcam frame
                            await predict();
                            window.requestAnimationFrame(loop);
                        }

                        // run the webcam image through the image model
                        async function predict() {
                            // predict can take in an image, video or canvas html element
                            const prediction = await model.predict(webcam.canvas);
                            for (let i = 0; i < maxPredictions; i++) {
                                const classPrediction =
                                    prediction[i].className + ": " + prediction[i].probability.toFixed(2);
                                labelContainer.childNodes[i].innerHTML = classPrediction;
                            }
                        }
                    </script>
            </div>

            <div class="bouton">
                <input type="submit" name="submit" value="S'inscrire" onclick="verifierBoutonRadio()"/>
            </div>

        </form>
    </body>
</html>