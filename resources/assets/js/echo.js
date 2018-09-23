import Bus from './bus'

Echo.join('channel-user')
    .here((users) => {
      Bus.$emit('user.here', users)
    })
    .joining((user) => {
      Bus.$emit('user.joining', users)
    })
    .leaving((user) => {
      Bus.$emit('user.leaving', users)
    })
    .listen('UserOnline', (e) => {
      Bus.$emit('user.data', e.data)
    })
