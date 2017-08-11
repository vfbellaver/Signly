
    @if(count($comments))
      @foreach($comments as $comment)

        @if($comment->message_from == 'admin')
        <div class="sidr-class-client_message">
          {{$comment->message}}
          
        </div>
        @endif
        @if($comment->message_from == 'client')
        <div class="sidr-class-admin_message" >
          {{$comment->message}}
          
        </div>
        @endif
      @endforeach
    @endif

           