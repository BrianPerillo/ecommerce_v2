self.addEventListener('push', function(event) {
    const data = event.data.json();
    const options = {
        body: data.name,
    };

    event.waitUntil(
        self.registration.showNotification(data.title, options)
    );
});

self.addEventListener('ecommerce-channel', function(event) {
    const data = event.data.json();
    const options = {
        body: 'asdf',
    };

    event.waitUntil(
        self.registration.showNotification('asdf', options)
    );
});