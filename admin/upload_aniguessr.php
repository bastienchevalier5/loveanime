<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Upload Opening</title>
</head>

<body>
    <div class="ag-admin-upload"
        style="padding:1rem; border:1px dashed var(--blue,#4F76BB); margin:1rem; border-radius:8px;">
        <strong><i class="fa-solid fa-lock-open"></i> Upload opening (admin)</strong><br>
        <input type="file" id="videoFile" accept="video/mp4">
        <button type="button" onclick="startUpload()">Uploader</button>
        <div id="uploadStatus"></div>
    </div>
</body>

<script>
    async function startUpload() {
        const fileInput = document.getElementById('videoFile');
        if (!fileInput.files.length) { alert("Choisis un fichier vidéo !"); return; }
        const file = fileInput.files[0];

        if (!file.name.toLowerCase().endsWith('.mp4')) {
            alert("Seuls les fichiers .mp4 sont acceptés.");
            return;
        }

        const chunkSize = 9 * 1024 * 1024;
        let start = 0, chunkIndex = 1;
        const status = document.getElementById("uploadStatus");

        async function uploadNextChunk() {
            const end = Math.min(start + chunkSize, file.size);
            const blob = file.slice(start, end);
            const formData = new FormData();
            formData.append('file', blob, `chunk_${chunkIndex}.tmp`);
            status.innerText = `Upload du morceau ${chunkIndex}...`;
            await fetch('../aniguessr/upload-chunk.php', { method: 'POST', body: formData, headers: { 'X-Admin-Token': 'MonSuperMotDePasseSecret123!' } });
            if (end < file.size) { start = end; chunkIndex++; uploadNextChunk(); }
            else {
                status.innerText = "Assemblage du fichier...";

                const secretToken = 'MonSuperMotDePasseSecret123!';
                // On repasse le nom de fichier brut et propre
                const response = await fetch(`../aniguessr/upload-chunk.php?merge=1&filename=${encodeURIComponent(file.name)}&token=${secretToken}`);
                const text = await response.text();

                status.innerText = text;
            }
        }
        uploadNextChunk();
    }
</script>

</html>