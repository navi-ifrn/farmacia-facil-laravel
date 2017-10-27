<div class="content" style="min-height: 0; padding-top: 0; padding-bottom: 0; position: relative;">
    <div class="system-alerts">
        @if(isset($errors) and count($errors) > 0)
            @if(is_string($errors))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    {{ $errors }}
                </div>
            @else
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <strong>Erro!</strong> {{ $error }}
                    </div>
                @endforeach
            @endif
        @endif

        @if(session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <strong>Aviso!</strong> {!! session('success') !!}
                <?php session()->forget('success'); ?>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <strong>Aviso!</strong> {!! session('error') !!}
                <?php session()->forget('error'); ?>
            </div>
        @endif

    </div>
</div>