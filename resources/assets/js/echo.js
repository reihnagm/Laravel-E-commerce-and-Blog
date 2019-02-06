import Bus from "./bus";


// CHANNEL CHAT 
Echo.join("channel-chat")
  .here(users => {
    Bus.$emit("chat.here", users);
  })
  .joining(user => {
    Bus.$emit("chat.joining", user);
  })
  .leaving(user => {
    Bus.$emit("chat.leaving", user);
  })
  .listen("ChatCreated", e => {
    Bus.$emit("chat.sent", e.message);
  });

