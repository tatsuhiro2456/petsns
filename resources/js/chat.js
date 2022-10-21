window.Echo.channel('message-added-channel')
.listen('MessageAdded',function(data){
   console.log('received a message');
   console.log(data);
   let newmessage = data.message[0].message;
   let name = data.message[1].name;
   let message = document.querySelector('#message_area');
   message.insertAdjacentHTML('beforeend',name+" "+newmessage +" "+data.message[0].created_at+"<br>");
 });

 //一度だけ実行される処理
 var xhr = new XMLHttpRequest();
 xhr.open('GET', '/allmessage');
 xhr.send();

 //最初にアクセスした時全てのメッセージを取得
 xhr.onreadystatechange = function() {
    if(xhr.readyState === 4 && xhr.status === 200) {
       const json = xhr.responseText;
       const obj = JSON.parse(json);
       console.log(obj);
       const message = document.querySelector('#message_area');
       for(let i = 0; i < obj.length; i++){
       message.insertAdjacentHTML('beforeend' , obj[i].user.name+" "+obj[i].message +" "+obj[i].created_at+"<br>");
       }
    }
}

 const submitbutton = document.querySelector('#submit');

 //送信ボタンをクリックした時
 submitbutton.addEventListener('click',()=>{
     const message = document.querySelector('#message');
     console.log(message.value);

     const xhr = new XMLHttpRequest();
     let token = document.getElementsByName('csrf-token').item(0).content;

     xhr.open('POST','https://44f87047aee74991bdd8c61421354714.vfs.cloud9.us-east-1.amazonaws.com/chatroom')
     xhr.setRequestHeader('X-CSRF-Token', token);
     xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded;charset=UTF-8');
     console.log(message.value);
     xhr.send("message="+message.value);
     message.value = '';
 });