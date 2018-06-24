<div>
    <h2>Новое обращение</h2>

    @foreach($data as $k => $v)
        <p> @lang("validation.attributes.$k") : {{ $v }} </p>
    @endforeach

    <p>
        Просмотреть все обращения можно в
        <a target="_blank" href="{{route('admin.dashboard')}}/contacts">
            административной панели
        </a>
    </p>
</div>