<style>
  .chat-box {
    float: left;
    margin-right: 10px;
  }
  .chat-box div{
    width:170px;
    height:200px;
    border:1px solid grey;
  }
  .chat-box input{
    width:172px;
    border:2px solid grey;
  }
</style>
<script src="http://node.localhost/socket.io/socket.io.js"></script>
<script src="http://node.localhost/easyrtc/easyrtc.js"></script>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>

<div class="chat-box" data-rid="room_meeting_001">
  <div></div>
  <input type="text"/>
</div>

<div class="chat-box" data-rid="room_meeting_002">
  <div></div>
  <input type="text"/>
</div>

<script>
  var remoteChatLabel = "Patient" // Doctor or Patient
  
  easyrtc.setSocketUrl("node.psccare.com");
  var roomName;
  
  // step1: connect to server.
  easyrtc.connect("easyrtc.instantMessaging", 
    function(){
      console.log('Connected = ' + easyrtc.myEasyrtcid);
  // step2: join all rooms
      $(".chat-box").each(function(){
        roomName = $(this).data("rid");
        easyrtc.joinRoom(roomName, null, null, null);
      });
    
  // step3: listen and update intended chat box
      function peerListener(who, msgType, content, targeting) {
        roomName = targeting.targetRoom;
        console.log(roomName);
        $(".chat-box[data-rid='"+roomName+"']").find("div").append( "<b>" + remoteChatLabel + "</b>: " + content + "<br>" );
      }
      easyrtc.setPeerListener(peerListener);
    
  // step4: type and post to intended room and current box
      function meListener(input, content){
        $(input).closest(".chat-box").find("div").append( "<b>Me</b>: " + content + "<br>" );
      }

      $(".chat-box input").on('keypress',function(e){
        if(e.which==13) {
          var sendText = $(this).val();
          var dest = {};
          dest.targetRoom = $(this).closest(".chat-box").data("rid");
          if(sendText) {
            $(this).val("");
            meListener(this, sendText);
            easyrtc.sendDataWS(dest, "message", sendText, function(reply) {
              if (reply.msgType === "error") {
                  easyrtc.showError(reply.msgData.errorCode, reply.msgData.errorText);
              }
            });
          }
        }
      });
    
    },
    function(){console.log('not connected yet...');}
  );
  
  
  
</script>
