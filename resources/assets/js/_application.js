let app = {
    routes: {
        list: '',
        create: '',
        store: '',
    },
    htmlTemplates: {
        create: null
    },
    selectors: {
        forms:{
            creation:"#creation-form",
            edition:"#edition-form",
        },
        buttons:{
            show:".show-button",
            edit:".edit-button",
            delete:".delete-button"
        }
    },
    containers: {
        main: $("main"),
        loader: $("#loader"),
        abort: $("#abort"),
        index: $("#index-container"),
        modal: $("#modal"),
        modalContent: $("#modal").find('.modal-content'),
    },
    actions: {
        refresh: function () {
            let self = app;
            return $.get(self.routes.list)
                .done(function (htmlResponse) {
                    self.containers.index.html(htmlResponse);
                });
        },
        show: function(ref){
            return $.get(ref)
                .done(function (htmlResponse) {
                    app.showModal(htmlResponse);
                });
        },
        create: function () {
            app.showModal(app.htmlTemplates.create.clone());
        },
        store: function (data) {
            let self = this;
            return $.post(app.routes.store, data)
                .done(function(){
                    self.refresh();
                    app.hideModal();
                    return new PNotify({text:"Contact created!",type:"success"});
                })
                .fail(function(r){

                    let messages = [];
                    for(key in r.responseJSON){
                        messages = messages.concat(r.responseJSON[key]);
                    }
                    messages.map(function(message){
                        return new PNotify({text:message,type:"error"});
                    });

                    app.hideModal();

                });
        },
        edit: function (ref) {
            return $.get(ref)
                .done(function (htmlResponse) {
                    app.showModal(htmlResponse);
                });
        },
        update: function (action, data) {
            let self = this;
            return $.post(action, data)
                .done(function(){
                    self.refresh();
                    app.hideModal();
                    return new PNotify({text:"Contact updated!",type:"success"});
                })
                .fail(function(r){

                    app.handleErrorMessages(r.responseJSON);
                    app.hideModal();

                });
        },
        delete: function (ref) {
            let self = this;

            if(!confirm("Do you really want to delete this contact?")){
                return;
            }

            return $.post(ref, {_method:"delete"})
                .done(function(){
                    self.refresh();
                    app.hideModal();
                    return new PNotify({text:"Contact deleted!",type:"success"});
                })
                .fail(function(r){

                    app.handleErrorMessages(r.responseJSON);
                    app.hideModal();

                });
        }
    },
    abort: function () {
        let self = this;
        this.containers.loader.hide('fast', function () {
            self.containers.loader.remove();
            self.containers.abort.show('fast');
        });
    },
    ready: function () {
        let self = this;
        this.containers.loader.hide('fast', function () {
            self.containers.loader.remove();
            self.containers.main.show('fast');
        });
    },
    handleErrorMessages:function(data){
        let messages = [];
        for(key in data){
            messages = messages.concat(data[key]);
        }
        messages.map(function(message){
            return new PNotify({text:message,type:"error"});
        });
    },
    showModal: function (content) {
        app.containers.modalContent.html(content);
        app.containers.modal.modal('show');
    },
    hideModal: function(){
        app.containers.modal.modal('hide');
    },
    retrieveTemplates: function () {
        let self = this;
        return $.get(self.routes.create)
            .done(function (htmlResponse) {
                self.htmlTemplates.create = $(htmlResponse);
            });
    },
    binds: function () {
        let self = this;
        this.containers.main.on("click", ".add-contact", function (e) {
            self.actions.create();
        });
        this.containers.main.on('submit', this.selectors.forms.creation, function(e){
            e.preventDefault();
            self.actions.store($(this).serialize());
        });
        this.containers.main.on('submit', this.selectors.forms.edition, function(e){
            e.preventDefault();
            let action = this.getAttribute('action');
            self.actions.update(action, $(this).serialize());
        });
        this.containers.main.on('click', this.selectors.buttons.show, function(){
            let ref = this.dataset.ref;
            app.actions.show(ref);
        });
        this.containers.main.on('click', this.selectors.buttons.edit, function(){
            let ref = this.dataset.ref;
            app.actions.edit(ref);
        });
        this.containers.main.on('click', this.selectors.buttons.delete, function(){
            let ref = this.dataset.ref;
            app.actions.delete(ref);
        });
        this.containers.modal.on('hidden.bs.modal', function(){
            self.containers.modalContent.html('');
        });
    },
    initialize: function () {
        return $.when(this.retrieveTemplates(), this.binds(), this.actions.refresh());
    }
};

module.exports = app;