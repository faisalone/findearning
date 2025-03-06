document.addEventListener('DOMContentLoaded', () => {
    // Initialize on each file input with data-uploader attribute
    document.querySelectorAll('input[data-uploader="true"]').forEach(imagesInput => {
        if (imagesInput._initialized) return;
        imagesInput._initialized = true;
        initUploader(imagesInput);
    });

    function initUploader(imagesInput) {
        const previewContainer = document.getElementById(imagesInput.getAttribute('data-preview'));
        if (!previewContainer) return;

        let allFiles = [], removedImages = [];
        const isMultiple = imagesInput.hasAttribute('multiple');

        const addExistingImages = () => {
            previewContainer.querySelectorAll('.existing-image').forEach((el, i) => {
                const row = document.createElement('div');
                row.className = 'd-flex justify-content-between align-items-center mb-2 w-100 flex-wrap p-2 shadow-sm';
                row.style.backgroundColor = i % 2 ? '#e9ecef' : '#f8f9fa';
                const left = document.createElement('div');
                left.className = 'd-flex align-items-center flex-grow-1';
                const img = el.querySelector('img');
                img.classList.add('img-thumbnail', 'mr-2');
                img.style.height = '50px';
                const span = document.createElement('span');
                span.textContent = img.src.split('/').pop();
                span.className = 'mr-2';
                const btn = document.createElement('button');
                btn.innerHTML = '<i class="fas fa-times-circle"></i>';
                btn.className = 'btn btn-outline-danger btn-sm';
                btn.style.width = '30px';
                btn.style.height = '30px';
                btn.dataset.id = el.dataset.id;
                btn.type = 'button';
                btn.addEventListener('click', () => {
                    removedImages.push(btn.dataset.id);
                    row.remove();
                });
                left.append(img, span);
                row.append(left, btn);
                previewContainer.appendChild(row);
            });
        };

        const compressImage = async (file) => {
            if (file.size <= 1_048_576) return { file, compressedFile: file };
            const dataURL = await new Promise((res, rej) => {
                const reader = new FileReader();
                reader.onload = e => res(e.target.result);
                reader.onerror = rej;
                reader.readAsDataURL(file);
            });
            const image = new Image();
            image.src = dataURL;
            await new Promise(r => image.onload = r);
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            let { width, height } = image;
            const maxSize = 1000;
            if (width > height && width > maxSize) {
                height *= maxSize / width;
                width = maxSize;
            } else if (height > maxSize) {
                width *= maxSize / height;
                height = maxSize;
            }
            canvas.width = width; canvas.height = height;
            ctx.drawImage(image, 0, 0, width, height);
            const blob = await new Promise(res => canvas.toBlob(res, file.type, 0.7));
            return { file, compressedFile: new File([blob], file.name, { type: file.type }) };
        };

        const compressImages = async (files) => await Promise.all(files.map(compressImage));

        const appendNewImages = (compressedFiles) => {
            compressedFiles.forEach((obj, i) => {
                const reader = new FileReader();
                reader.onload = e => {
                    const row = document.createElement('div');
                    row.className = 'd-flex justify-content-between align-items-center mb-2 w-100 flex-wrap p-2 shadow-sm';
                    row.style.backgroundColor = (allFiles.length + i) % 2 ? '#e9ecef' : '#f8f9fa';
                    const left = document.createElement('div');
                    left.className = 'd-flex align-items-center flex-grow-1';
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-thumbnail mr-2';
                    img.style.height = '50px';
                    const span = document.createElement('span');
                    span.textContent = obj.file.name;
                    span.className = 'mr-2';
                    const oldSize = document.createElement('span');
                    oldSize.textContent = `Old: ${(obj.file.size/1024).toFixed(2)} KB`;
                    oldSize.className = 'mr-2';
                    const newSize = document.createElement('span');
                    newSize.textContent = `New: ${(obj.compressedFile.size/1024).toFixed(2)} KB`;
                    newSize.className = 'mr-2';
                    const btn = document.createElement('button');
                    btn.innerHTML = '<i class="fas fa-times-circle"></i>';
                    btn.className = 'btn btn-outline-danger btn-sm';
                    btn.style.width = '30px';
                    btn.style.height = '30px';
                    btn.type = 'button';
                    btn.addEventListener('click', () => {
                        allFiles = allFiles.filter(f => f !== obj);
                        row.remove();
                    });
                    left.append(img, span, oldSize, newSize);
                    row.append(left, btn);
                    previewContainer.appendChild(row);
                };
                reader.readAsDataURL(obj.compressedFile);
            });
            const dt = new DataTransfer();
            allFiles.forEach(o => dt.items.add(o.compressedFile));
            imagesInput.files = dt.files;
        };

        imagesInput.addEventListener('change', async (e) => {
            let files = Array.from(e.target.files);
            if (!isMultiple) {
                // For single image, clear previous selections and preview
                allFiles = [];
                previewContainer.innerHTML = '';
            }
            const compressed = await compressImages(files);
            allFiles = isMultiple ? allFiles.concat(compressed) : compressed;
            appendNewImages(compressed);
        });

        // Optionally, add removed images info on form submit
        const form = imagesInput.closest('form');
        if (form) {
            form.addEventListener('submit', function() {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'removed_images';
                input.value = JSON.stringify(removedImages);
                this.appendChild(input);
            });
        }

        addExistingImages();
    }
});
