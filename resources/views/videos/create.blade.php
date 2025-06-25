<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-yellow-50 py-8">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Header Section -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold mb-3 bg-gradient-to-r from-purple-600 via-pink-500 to-yellow-500 bg-clip-text text-transparent" style="font-family: 'Quicksand', sans-serif;">
                    Upload Video
                </h1>
                <p class="text-gray-600">
                    Share your educational content with the EqualLearn community
                </p>
            </div>

            <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data" id="video-upload-form">
                @csrf
                <!-- Main Upload Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Left Side - Upload Area -->
                    <div class="space-y-6">
                        <!-- Video Upload Section -->
                        <div class="upload-card">
                            <div class="upload-header">
                                <h2 class="upload-section-title">Select files to upload</h2>
                                <p class="upload-subtitle">Or drag and drop video files</p>
                            </div>
                            
                            <div id="drop-area" class="youtube-drop-area">
                                <div class="upload-icon-container">
                                    <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                </div>
                                <div class="upload-text">
                                    <h3 class="upload-main-text">Drag and drop video files to upload</h3>
                                    <p class="upload-sub-text">Your videos will be private until you publish them.</p>
                                </div>
                                <button type="button" class="upload-btn" onclick="document.getElementById('video_file').click()">
                                    SELECT FILES
                                </button>
                                <input type="file" name="video_file" id="video_file" accept="video/*" style="display:none;" required>
                                <div class="upload-limits">
                                    <p>Maximum file size: 1GB</p>
                                    <p>Supported formats: MP4, AVI, MOV, WMV, FLV, WebM</p>
                                </div>
                            </div>

                            <!-- Video Preview -->
                            <div id="video-preview-container" class="video-preview-section" style="display:none;">
                                <div class="preview-header">
                                    <h3>Video Preview</h3>
                                    <button type="button" class="remove-video-btn" onclick="removeVideo()">Remove</button>
                                </div>
                                <video id="video-preview" controls class="video-preview"></video>
                                <div class="upload-progress" style="display:none;">
                                    <div class="progress-bar">
                                        <div class="progress-fill"></div>
                                    </div>
                                    <span class="progress-text">Uploading...</span>
                                </div>
                            </div>
                        </div>

                        <!-- Thumbnail Upload -->
                        <div class="upload-card">
                            <h3 class="upload-section-title">Thumbnail</h3>
                            <p class="upload-subtitle">Select or upload a picture that shows what's in your video</p>
                            
                            <div class="thumbnail-upload-area">
                                <input type="file" name="thumbnail" id="thumbnail" accept="image/*" style="display:none;" required>
                                <div class="thumbnail-drop-zone" onclick="document.getElementById('thumbnail').click()">
                                    <div id="thumbnail-preview-container" style="display:none;">
                                        <img id="thumbnail-preview" class="thumbnail-preview" />
                                        <div class="thumbnail-overlay">
                                            <span>Change thumbnail</span>
                                        </div>
                                    </div>
                                    <div id="thumbnail-placeholder" class="thumbnail-placeholder">
                                        <svg class="thumbnail-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>Upload thumbnail</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side - Video Details Form -->
                    <div class="space-y-6">
                        <div class="details-card">
                            <h2 class="details-title">Details</h2>
                            
                            <div class="form-group">
                                <label for="title" class="form-label">Title (required)</label>
                                <input type="text" name="title" id="title" value="{{ old('title') }}" 
                                       placeholder="Add a title that describes your video" 
                                       class="form-input" required maxlength="100">
                                <div class="char-counter">
                                    <span id="title-counter">0</span>/100
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" rows="6" 
                                          placeholder="Tell viewers about your video" 
                                          class="form-textarea" required maxlength="1000">{{ old('description') }}</textarea>
                                <div class="char-counter">
                                    <span id="desc-counter">0</span>/1000
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select name="category_id" id="category_id" class="form-select" required>
                                        <option value="">Choose a category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="country_id" class="form-label">Country</label>
                                    <select name="country_id" id="country_id" class="form-select" required>
                                        <option value="">Choose a country</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                                {{ $country->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Content Type Card -->
                        <div class="visibility-card">
                            <h3 class="visibility-title">Content type</h3>
                            <div class="visibility-option">
                                <div class="visibility-info">
                                    <div class="visibility-icon">�</div>
                                    <div>
                                        <h4>Free</h4>
                                        <p>Users can watch this content without availing the premium package</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-buttons">
                            <button type="button" class="btn-secondary" onclick="window.location.href='{{ route('home') }}'">
                                Cancel
                            </button>
                            <button type="submit" class="btn-primary">
                                Publish
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <style>
        /* YouTube-inspired Upload Styles */
        .upload-card, .details-card, .visibility-card {
            background: linear-gradient(135deg, #fff7c2 0%, #ffd5de 100%);
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(254, 138, 139, 0.08);
            border: 1.5px solid #f6e6e6;
            padding: 24px;
            transition: all 0.3s ease;
        }

        .upload-card:hover, .details-card:hover, .visibility-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(254, 138, 139, 0.12);
        }

        .upload-header {
            text-align: center;
            margin-bottom: 24px;
        }

        .upload-section-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #fe8a8b;
            margin-bottom: 8px;
        }

        .upload-subtitle {
            color: #8a95a9;
            font-size: 0.9rem;
        }

        .youtube-drop-area {
            border: 2px dashed #fe8a8b;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.6);
            padding: 48px 24px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .youtube-drop-area:hover {
            border-color: #ff6b9d;
            background: rgba(255, 255, 255, 0.8);
        }

        .upload-icon-container {
            margin-bottom: 16px;
        }

        .upload-icon {
            width: 48px;
            height: 48px;
            color: #fe8a8b;
            margin: 0 auto;
        }

        .upload-text {
            margin-bottom: 24px;
        }

        .upload-main-text {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1c1e21;
            margin-bottom: 8px;
        }

        .upload-sub-text {
            font-size: 0.9rem;
            color: #8a95a9;
        }

        .upload-btn {
            background: linear-gradient(90deg, #fe8a8b 0%, #fff7c2 100%);
            color: white;
            font-weight: 700;
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .upload-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(254, 138, 139, 0.3);
        }

        .upload-limits {
            margin-top: 20px;
            font-size: 0.8rem;
            color: #8a95a9;
            line-height: 1.4;
        }

        .video-preview-section {
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid #f0f0f0;
        }

        .preview-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 16px;
        }

        .preview-header h3 {
            font-weight: 600;
            color: #1c1e21;
            margin: 0;
        }

        .remove-video-btn {
            background: none;
            border: 1px solid #fe8a8b;
            color: #fe8a8b;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .remove-video-btn:hover {
            background: #fe8a8b;
            color: white;
        }

        .video-preview {
            width: 100%;
            max-height: 300px;
            border-radius: 8px;
            background: #f8f9fc;
        }

        /* Thumbnail Styles */
        .thumbnail-upload-area {
            margin-top: 16px;
        }

        .thumbnail-drop-zone {
            position: relative;
            border: 2px dashed #fe8a8b;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.6);
            cursor: pointer;
            transition: all 0.3s ease;
            aspect-ratio: 16/9;
            max-width: 240px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .thumbnail-drop-zone:hover {
            border-color: #ff6b9d;
            background: rgba(255, 255, 255, 0.8);
        }

        .thumbnail-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            color: #8a95a9;
        }

        .thumbnail-icon {
            width: 32px;
            height: 32px;
        }

        .thumbnail-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 6px;
        }

        .thumbnail-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .thumbnail-drop-zone:hover .thumbnail-overlay {
            opacity: 1;
        }

        /* Form Styles */
        .details-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #fe8a8b;
            margin-bottom: 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #1c1e21;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .form-input, .form-textarea, .form-select {
            width: 100%;
            border: 1px solid #e0e4e7;
            border-radius: 8px;
            padding: 12px;
            font-size: 0.9rem;
            background: white;
            transition: border-color 0.3s ease;
        }

        .form-input:focus, .form-textarea:focus, .form-select:focus {
            outline: none;
            border-color: #fe8a8b;
            box-shadow: 0 0 0 3px rgba(254, 138, 139, 0.1);
        }

        .form-textarea {
            resize: vertical;
            min-height: 120px;
        }

        .char-counter {
            text-align: right;
            font-size: 0.8rem;
            color: #8a95a9;
            margin-top: 4px;
        }

        /* Visibility Card */
        .visibility-title {
            font-weight: 600;
            color: #1c1e21;
            margin-bottom: 16px;
        }

        .visibility-option {
            padding: 16px;
            border: 1px solid #e0e4e7;
            border-radius: 8px;
            background: white;
        }

        .visibility-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .visibility-icon {
            font-size: 1.5rem;
        }

        .visibility-info h4 {
            margin: 0 0 4px 0;
            font-weight: 600;
            color: #1c1e21;
        }

        .visibility-info p {
            margin: 0;
            font-size: 0.9rem;
            color: #8a95a9;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        .btn-secondary {
            background: white;
            border: 1px solid #e0e4e7;
            color: #1c1e21;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: #f8f9fc;
        }

        .btn-primary {
            background: linear-gradient(90deg, #fe8a8b 0%, #fff7c2 100%);
            border: none;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(254, 138, 139, 0.3);
        }

        .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        /* Progress Bar */
        .upload-progress {
            margin-top: 16px;
        }

        .progress-bar {
            width: 100%;
            height: 6px;
            background: #e0e4e7;
            border-radius: 3px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #fe8a8b 0%, #fff7c2 100%);
            width: 0%;
            transition: width 0.3s ease;
        }

        .progress-text {
            display: block;
            margin-top: 8px;
            font-size: 0.9rem;
            color: #8a95a9;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .grid-cols-1.lg\\:grid-cols-2 {
                grid-template-columns: 1fr !important;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .youtube-drop-area {
                padding: 32px 16px;
            }
        }
    </style>

    <script>
        // YouTube-inspired Upload Functionality
        const dropArea = document.getElementById('drop-area');
        const videoInput = document.getElementById('video_file');
        const videoPreview = document.getElementById('video-preview');
        const videoPreviewContainer = document.getElementById('video-preview-container');
        const titleInput = document.getElementById('title');
        const descInput = document.getElementById('description');
        const titleCounter = document.getElementById('title-counter');
        const descCounter = document.getElementById('desc-counter');

        // File upload functionality
        dropArea.addEventListener('click', () => videoInput.click());
        
        dropArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropArea.style.borderColor = '#ff6b9d';
            dropArea.style.background = 'rgba(255, 255, 255, 0.8)';
        });
        
        dropArea.addEventListener('dragleave', (e) => {
            e.preventDefault();
            dropArea.style.borderColor = '#fe8a8b';
            dropArea.style.background = 'rgba(255, 255, 255, 0.6)';
        });
        
        dropArea.addEventListener('drop', (e) => {
            e.preventDefault();
            dropArea.style.borderColor = '#fe8a8b';
            dropArea.style.background = 'rgba(255, 255, 255, 0.6)';
            videoInput.files = e.dataTransfer.files;
            showVideoPreview();
        });

        videoInput.addEventListener('change', showVideoPreview);

        function showVideoPreview() {
            const file = videoInput.files[0];
            if (file) {
                // Check file size (1GB limit)
                if (file.size > 1024 * 1024 * 1024) {
                    alert('File size exceeds 1GB limit. Please choose a smaller file.');
                    videoInput.value = '';
                    return;
                }
                
                const url = URL.createObjectURL(file);
                videoPreview.src = url;
                videoPreviewContainer.style.display = 'block';
                
                // Auto-generate title from filename if empty
                if (!titleInput.value) {
                    const fileName = file.name.replace(/\.[^/.]+$/, "");
                    titleInput.value = fileName.replace(/[-_]/g, ' ');
                    updateCounter(titleInput, titleCounter, 100);
                }
            }
        }

        function removeVideo() {
            videoInput.value = '';
            videoPreviewContainer.style.display = 'none';
            videoPreview.src = '';
        }

        // Thumbnail functionality
        const thumbInput = document.getElementById('thumbnail');
        const thumbPreview = document.getElementById('thumbnail-preview');
        const thumbPreviewContainer = document.getElementById('thumbnail-preview-container');
        const thumbPlaceholder = document.getElementById('thumbnail-placeholder');

        thumbInput.addEventListener('change', function() {
            const file = thumbInput.files[0];
            if (file) {
                const url = URL.createObjectURL(file);
                thumbPreview.src = url;
                thumbPreviewContainer.style.display = 'block';
                thumbPlaceholder.style.display = 'none';
            }
        });

        // Character counters
        titleInput.addEventListener('input', () => updateCounter(titleInput, titleCounter, 100));
        descInput.addEventListener('input', () => updateCounter(descInput, descCounter, 1000));

        function updateCounter(input, counter, max) {
            const current = input.value.length;
            counter.textContent = current;
            counter.style.color = current > max * 0.9 ? '#ff6b6b' : '#8a95a9';
        }

        // Initialize counters
        updateCounter(titleInput, titleCounter, 100);
        updateCounter(descInput, descCounter, 1000);

        // Form validation
        document.getElementById('video-upload-form').addEventListener('submit', function(e) {
            if (!videoInput.files[0]) {
                e.preventDefault();
                alert('Please select a video file.');
                return;
            }
            
            if (!thumbInput.files[0]) {
                e.preventDefault();
                alert('Please select a thumbnail image.');
                return;
            }
            
            // Disable submit button to prevent double submission
            const submitBtn = document.querySelector('.btn-primary');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Publishing...';
        });
    </script>
</x-app-layout>
