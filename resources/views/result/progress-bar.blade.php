
<div id="el-result" class="el-progress-bar">
    <input type="search" required name="url" id="url" placeholder="{{ $message ?? 'URL de la vidéo' }}" @if(isset($data->readyOnly) && $data->readyOnly) readonly @endif>
    <div style="width: {{ $data->width ?? 0 }}" class="el-progress"></div>
</div>
