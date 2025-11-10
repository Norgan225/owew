<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Upload Gallery</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .test-box {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .info {
            background: #e3f2fd;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .success {
            background: #c8e6c9;
            padding: 15px;
            border-radius: 4px;
            margin-top: 20px;
        }
        .error {
            background: #ffcdd2;
            padding: 15px;
            border-radius: 4px;
            margin-top: 20px;
        }
        input[type="file"] {
            margin: 20px 0;
        }
        button {
            background: #4B0082;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background: #6A0DAD;
        }
        .preview {
            margin-top: 20px;
        }
        .preview img {
            max-width: 200px;
            margin: 10px;
            border: 2px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="test-box">
        <h1>🧪 Test Upload Gallery (Local)</h1>

        <div class="info">
            <h3>Configuration PHP actuelle:</h3>
            <ul>
                <li><strong>upload_max_filesize:</strong> <?php echo ini_get('upload_max_filesize'); ?></li>
                <li><strong>post_max_size:</strong> <?php echo ini_get('post_max_size'); ?></li>
                <li><strong>max_file_uploads:</strong> <?php echo ini_get('max_file_uploads'); ?></li>
                <li><strong>PHP Version:</strong> <?php echo PHP_VERSION; ?></li>
            </ul>
        </div>

        <form id="testForm" action="/admin/gallery" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="media_type" value="image">
            <input type="hidden" name="is_published" value="1">

            <h3>Sélectionnez des images (max 2MB chacune):</h3>
            <input type="file" name="images[]" id="imageInput" multiple accept="image/*">

            <div class="preview" id="preview"></div>

            <button type="submit">📤 Envoyer au serveur</button>
            <button type="button" onclick="window.location.href='/admin/gallery'">🔙 Voir la galerie</button>
        </form>

        <div id="result"></div>
    </div>

    <script>
        document.getElementById('imageInput').addEventListener('change', function(e) {
            const files = Array.from(e.target.files);
            const preview = document.getElementById('preview');
            preview.innerHTML = '<h4>Aperçu des images sélectionnées:</h4>';

            files.forEach((file, index) => {
                const reader = new FileReader();
                const sizeMB = (file.size / (1024 * 1024)).toFixed(2);

                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.style.display = 'inline-block';
                    div.innerHTML = `
                        <img src="${e.target.result}" alt="${file.name}">
                        <p style="text-align:center; font-size:12px;">
                            ${file.name}<br>
                            ${sizeMB} MB
                            ${file.size > 2 * 1024 * 1024 ? '❌ Trop gros!' : '✅ OK'}
                        </p>
                    `;
                    preview.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        });

        document.getElementById('testForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const result = document.getElementById('result');
            result.innerHTML = '<div class="info">⏳ Envoi en cours...</div>';

            fetch('/admin/gallery', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                console.log('Response status:', response.status);
                return response.text().then(text => ({
                    status: response.status,
                    text: text
                }));
            })
            .then(data => {
                console.log('Response:', data);
                if (data.status === 200 || data.status === 302) {
                    result.innerHTML = '<div class="success">✅ Upload réussi! Redirection vers la galerie...</div>';
                    setTimeout(() => window.location.href = '/admin/gallery', 2000);
                } else {
                    result.innerHTML = `<div class="error">❌ Erreur ${data.status}<br><pre>${data.text}</pre></div>`;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                result.innerHTML = `<div class="error">❌ Erreur: ${error.message}</div>`;
            });
        });
    </script>
</body>
</html>
