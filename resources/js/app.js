require('./bootstrap');

Echo.private(`App.Models.User.${userId}`)
    .notification((notification) => {
        alert(notification.body);
    });
