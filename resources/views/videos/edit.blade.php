<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-yellow-50 py-8">
        <div class="max-w-6xl mx-auto px-4">
            <!-- Header Section -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold mb-3 bg-gradient-to-r from-purple-600 via-pink-500 to-yellow-500 bg-clip-text text-transparent" style="font-family: 'Quicksand', sans-serif;">
                    Edit Your Video ✨
                </h1>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Update your video details and content. Changes to the video file will require re-approval.
                </p>
            </div>

            <div class="upload-form-container">
                <form action="{{ route('videos.update', $video) }}" method="POST" enctype="multipart/form-data" id="video-edit-form">
                    @csrf
                    @method('PUT')

                    <!-- Current Video Preview -->
                    <div class="current-video mb-6">
                        <label>Current Video</label>
                        <div style="aspect-ratio: 16/9; background: #000; border-radius: 12px; overflow: hidden; margin-bottom: 10px;">
                            @if(Str::startsWith($video->video_url, 'videos/'))
                                <video controls style="width: 100%; height: 100%;">
                                    <source src="{{ Storage::url($video->video_url) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @else
                                <iframe
                                    style="width: 100%; height: 100%;"
                                    src="{{ $video->video_url }}"
                                    frameborder="0"
                                    allowfullscreen>
                                </iframe>
                            @endif
                        </div>
                    </div>

                    <label for="video_file">Replace Video (Optional)</label>
                    <div id="drop-area" class="drop-area">
                        Drop new video here or click to browse<br>
                        <span style="font-size:0.98rem; color:#8a95a9; font-weight:400;">Leave empty to keep current video. Supports MP4, AVI, MOV, and more</span>
                        <input type="file" name="video_file" id="video_file" accept="video/*" style="display:none;">
                    </div>
                    <div id="video-preview-container" style="display:none;">
                        <video id="video-preview" controls class="video-preview"></video>
                    </div>

                    <label for="title">Video Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $video->title) }}" placeholder="Give your video an engaging title..." required>

                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="4" placeholder="Describe what viewers will learn from your video..." required>{{ old('description', $video->description) }}</textarea>

                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id" required>
                        <option value="">Choose a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $video->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>

                    <label for="country_id">Country</label>
                    <select name="country_id" id="country_id" required>
                        <option value="">Choose a country</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" {{ old('country_id', $video->country_id) == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                        @endforeach
                    </select>

                    <!-- Current Thumbnail Preview -->
                    <div class="current-thumbnail mb-4">
                        <label>Current Thumbnail</label>
                        <div style="margin-bottom: 10px;">
                            <img src="{{ Storage::url($video->thumbnail) }}" alt="Current thumbnail" style="max-width: 200px; height: auto; border-radius: 8px; border: 2px solid #e3e7f0;">
                        </div>
                    </div>

                    <label for="thumbnail">Replace Thumbnail (Optional)</label>
                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*">
                    <div id="thumbnail-preview-container" style="display:none;">
                        <img id="thumbnail-preview" class="thumbnail-preview" />
                    </div>

                    <div class="form-actions" style="display: flex; gap: 12px; margin-top: 20px;">
                        <button type="submit" style="flex: 1;">Update Video</button>
                        <a href="{{ route('videos.show', $video) }}" style="flex: 1; display: inline-flex; align-items: center; justify-content: center; text-decoration: none; background: #6b7280; color: white; padding: 14px 20px; border-radius: 12px; font-weight: 600; transition: all 0.3s ease;">
                            Cancel
                        </a>
                    </div>

                    <div class="tips">
                        <h3>💡 Tips for a Great Video</h3>
                        <ul>
                            <li>🎬 Use clear, concise titles that describe your content</li>
                            <li>📝 Write detailed descriptions to help viewers understand the value</li>
                            <li>🖼️ Choose eye-catching thumbnails that represent your content</li>
                            <li>🔄 Replacing the video file will require re-approval from our team</li>
                            <li>⚡ Only update thumbnail and details if you want to keep current approval status</li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .upload-form-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 24px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.06);
            border: 1px solid rgba(255,255,255,0.9);
        }

        .upload-form-container label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            margin-top: 20px;
            font-size: 1rem;
        }

        .upload-form-container label:first-child {
            margin-top: 0;
        }

        .upload-form-container input[type="text"],
        .upload-form-container textarea,
        .upload-form-container select {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #fafafa;
        }

        .upload-form-container input[type="text"]:focus,
        .upload-form-container textarea:focus,
        .upload-form-container select:focus {
            outline: none;
            border-color: #8b5cf6;
            background: white;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
        }

        .upload-form-container textarea {
            resize: vertical;
            min-height: 100px;
        }

        .drop-area {
            border: 3px dashed #d1d5db;
            border-radius: 12px;
            padding: 40px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #fafafa;
            color: #6b7280;
            font-weight: 500;
        }

        .drop-area:hover,
        .drop-area.dragover {
            border-color: #8b5cf6;
            background: #f3f4f6;
            color: #8b5cf6;
        }

        .video-preview,
        .thumbnail-preview {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            margin-top: 10px;
            border: 2px solid #e5e7eb;
        }

        .upload-form-container button[type="submit"] {
            width: 100%;
            background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
            color: white;
            padding: 16px 24px;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .upload-form-container button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(139, 92, 246, 0.3);
        }

        .tips {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            padding: 20px;
            border-radius: 12px;
            margin-top: 30px;
            border: 1px solid #f59e0b;
        }

        .tips h3 {
            margin: 0 0 12px 0;
            color: #92400e;
            font-size: 1.1rem;
        }

        .tips ul {
            margin: 0;
            padding-left: 0;
            list-style: none;
        }

        .tips li {
            margin-bottom: 8px;
            color: #92400e;
            font-size: 0.95rem;
        }

        .current-video,
        .current-thumbnail {
            background: #f9fafb;
            padding: 16px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
        }

        .current-video label,
        .current-thumbnail label {
            margin-top: 0 !important;
            margin-bottom: 12px !important;
            color: #6b7280;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
    </style>

    <script>
        // File drop functionality
        const dropArea = document.getElementById('drop-area');
        const videoInput = document.getElementById('video_file');
        const thumbnailInput = document.getElementById('thumbnail');
        const videoPreviewContainer = document.getElementById('video-preview-container');
        const videoPreview = document.getElementById('video-preview');
        const thumbnailPreviewContainer = document.getElementById('thumbnail-preview-container');
        const thumbnailPreview = document.getElementById('thumbnail-preview');

        dropArea.addEventListener('click', () => videoInput.click());
        dropArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropArea.classList.add('dragover');
        });
        dropArea.addEventListener('dragleave', () => {
            dropArea.classList.remove('dragover');
        });
        dropArea.addEventListener('drop', (e) => {
            e.preventDefault();
            dropArea.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                videoInput.files = files;
                handleVideoPreview(files[0]);
            }
        });

        videoInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleVideoPreview(e.target.files[0]);
            }
        });

        thumbnailInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                const reader = new FileReader();
                reader.onload = (e) => {
                    thumbnailPreview.src = e.target.result;
                    thumbnailPreviewContainer.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });

        function handleVideoPreview(file) {
            const url = URL.createObjectURL(file);
            videoPreview.src = url;
            videoPreviewContainer.style.display = 'block';
        }
    </script>
</x-app-layout>
