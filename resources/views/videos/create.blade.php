<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-yellow-50 py-8">
        <div class="max-w-6xl mx-auto px-4">
            <!-- Header Section -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold mb-3 bg-gradient-to-r from-purple-600 via-pink-500 to-yellow-500 bg-clip-text text-transparent" style="font-family: 'Quicksand', sans-serif;">
                    Upload Your Video ✨
                </h1>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Share your knowledge and creativity with the EqualLearn community! Upload your educational content and inspire learners worldwide.
                </p>
            </div>

            <div class="upload-form-container">
                <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data" id="video-upload-form">
                    @csrf
                    <label for="video_file">Select Your Video</label>
                    <div id="drop-area" class="drop-area">
                        Drop your video here or click to browse<br>
                        <span style="font-size:0.98rem; color:#8a95a9; font-weight:400;">Supports MP4, AVI, MOV, and more</span>
                        <input type="file" name="video_file" id="video_file" accept="video/*" style="display:none;" required>
                    </div>
                    <div id="video-preview-container" style="display:none;">
                        <video id="video-preview" controls class="video-preview"></video>
                    </div>
                    <label for="title">Video Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Give your video an engaging title..." required>
                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="4" placeholder="Describe what viewers will learn from your video..." required>{{ old('description') }}</textarea>
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id" required>
                        <option value="">Choose a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <label for="thumbnail">Thumbnail</label>
                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*" required>
                    <div id="thumbnail-preview-container" style="display:none;">
                        <img id="thumbnail-preview" class="thumbnail-preview" />
                    </div>
                    <button type="submit">Upload & Publish</button>
                    <div class="tips">
                        <strong>Tips:</strong>
                        <ul style="margin: 0.5em 0 0 1.2em; padding: 0; text-align: left;">
                            <li>Keep videos under 500MB for best performance</li>
                            <li>Use clear, descriptive titles</li>
                            <li>Choose eye-catching thumbnails</li>
                            <li>Add detailed descriptions for better discovery</li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .upload-form-container {
            background: linear-gradient(135deg, #fff7c2 0%, #ffd5de 100%);
            border-radius: 28px;
            box-shadow: 0 8px 32px 0 rgba(254, 138, 139, 0.08), 0 1.5px 8px 0 rgba(208, 230, 250, 0.10);
            border: 1.5px solid #f6e6e6;
            padding: 32px 28px 28px 28px;
            max-width: 600px;
            margin: 0 auto;
        }
        .upload-form-container h1 {
            font-family: 'Bubblegum Sans', 'Quicksand', sans-serif;
            font-size: 2.2rem;
            color: #fe8a8b;
            margin-bottom: 1.2rem;
        }
        .upload-form-container label {
            font-family: 'Quicksand', sans-serif;
            font-weight: 700;
            color: #fe8a8b;
            margin-bottom: 0.5rem;
            display: block;
        }
        .upload-form-container input[type="text"],
        .upload-form-container textarea,
        .upload-form-container select {
            width: 100%;
            border: 1.5px solid #ffd5de;
            border-radius: 12px;
            padding: 10px 14px;
            font-size: 1rem;
            margin-bottom: 1.1rem;
            background: #fff;
            transition: border 0.2s;
        }
        .upload-form-container input[type="text"]:focus,
        .upload-form-container textarea:focus,
        .upload-form-container select:focus {
            border: 1.5px solid #fe8a8b;
            outline: none;
        }
        .upload-form-container .drop-area {
            border: 2px dashed #fe8a8b;
            border-radius: 18px;
            background: #fff7c2;
            padding: 32px 18px;
            text-align: center;
            margin-bottom: 1.2rem;
            color: #fe8a8b;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background 0.2s, border 0.2s;
        }
        .upload-form-container .drop-area:hover {
            background: #ffd5de;
            border-color: #fe8a8b;
        }
        .upload-form-container .video-preview {
            width: 100%;
            border-radius: 16px;
            margin-bottom: 1.1rem;
            background: #f8f9fc;
            border: 1.5px solid #ffe6e6;
        }
        .upload-form-container .thumbnail-preview {
            width: 100%;
            border-radius: 12px;
            margin-bottom: 1.1rem;
            background: #f8f9fc;
            border: 1.5px solid #ffe6e6;
        }
        .upload-form-container button[type="submit"] {
            background: linear-gradient(90deg, #fe8a8b 0%, #fff7c2 100%);
            color: #fff;
            font-weight: 700;
            border: none;
            border-radius: 12px;
            padding: 12px 0;
            font-size: 1.1rem;
            width: 100%;
            margin-top: 0.5rem;
            box-shadow: 0 2px 8px 0 rgba(254, 138, 139, 0.10);
            transition: background 0.2s, color 0.2s;
            cursor: pointer;
        }
        .upload-form-container button[type="submit"]:hover {
            background: linear-gradient(90deg, #fff7c2 0%, #fe8a8b 100%);
            color: #fe8a8b;
        }
        .upload-form-container .tips {
            background: #fff7c2;
            border-radius: 12px;
            padding: 12px 16px;
            color: #8a95a9;
            font-size: 0.98rem;
            margin-top: 1.2rem;
            border: 1.5px solid #ffe6e6;
        }
    </style>

    <script>
        // Drag & drop and preview logic
        const dropArea = document.getElementById('drop-area');
        const videoInput = document.getElementById('video_file');
        const videoPreview = document.getElementById('video-preview');
        const videoPreviewContainer = document.getElementById('video-preview-container');
        dropArea.addEventListener('click', () => videoInput.click());
        dropArea.addEventListener('dragover', e => { e.preventDefault(); dropArea.classList.add('hover'); });
        dropArea.addEventListener('dragleave', e => { e.preventDefault(); dropArea.classList.remove('hover'); });
        dropArea.addEventListener('drop', e => {
            e.preventDefault();
            dropArea.classList.remove('hover');
            videoInput.files = e.dataTransfer.files;
            showVideoPreview();
        });
        videoInput.addEventListener('change', showVideoPreview);
        function showVideoPreview() {
            const file = videoInput.files[0];
            if (file) {
                const url = URL.createObjectURL(file);
                videoPreview.src = url;
                videoPreviewContainer.style.display = '';
            } else {
                videoPreviewContainer.style.display = 'none';
            }
        }
        // Thumbnail preview
        const thumbInput = document.getElementById('thumbnail');
        const thumbPreview = document.getElementById('thumbnail-preview');
        const thumbPreviewContainer = document.getElementById('thumbnail-preview-container');
        thumbInput.addEventListener('change', function() {
            const file = thumbInput.files[0];
            if (file) {
                const url = URL.createObjectURL(file);
                thumbPreview.src = url;
                thumbPreviewContainer.style.display = '';
            } else {
                thumbPreviewContainer.style.display = 'none';
            }
        });
    </script>
</x-app-layout>
