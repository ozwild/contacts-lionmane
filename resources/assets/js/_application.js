let app = {
    routes: {
        list: '',
        create: '',
        store: '',
        attributeGroup: ''
    },
    htmlTemplates: {
        create: null,
        attributeGroup: null
    },
    selectors: {
        forms: {
            creation: "#creation-form",
            edition: "#edition-form",
        },
        buttons: {
            show: ".show-button",
            edit: ".edit-button",
            delete: ".delete-button"
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
        show: function (ref) {
            return $.get(ref)
                .done(function (htmlResponse) {
                    app.showModal(htmlResponse);
                });
        },
        create: function () {
            app.showModal(app.htmlTemplates.create.clone());
            $('.attribute-form .attribute-type').each(function (a, attributeTypeSelector) {
                app.updateAttributeBlock(attributeTypeSelector);
            });
        },
        store: function (data) {
            let self = this;
            return $.post(app.routes.store, data)
                .done(function () {
                    self.refresh();
                    app.hideModal();
                    return new PNotify({text: "Contact created!", type: "success"});
                })
                .fail(function (r) {

                    app.handleErrorMessages(r.responseJSON);

                    app.hideModal();

                });
        },
        edit: function (ref) {
            return $.get(ref)
                .done(function (htmlResponse) {
                    app.showModal(htmlResponse);
                    $('.attribute-form .attribute-type').each(function (a, attributeTypeSelector) {
                        app.updateAttributeBlock(attributeTypeSelector);
                    });
                });
        },
        update: function (action, data) {
            let self = this;
            return $.post(action, data)
                .done(function () {
                    self.refresh();
                    app.hideModal();
                    return new PNotify({text: "Contact updated!", type: "success"});
                })
                .fail(function (r) {

                    app.handleErrorMessages(r.responseJSON);
                    app.hideModal();

                });
        },
        delete: function (ref) {
            let self = this;

            if (!confirm("Do you really want to delete this contact?")) {
                return;
            }

            return $.post(ref, {_method: "delete"})
                .done(function () {
                    self.refresh();
                    app.hideModal();
                    return new PNotify({text: "Contact deleted!", type: "success"});
                })
                .fail(function (r) {

                    app.handleErrorMessages(r.responseJSON);
                    app.hideModal();

                });
        }
    },
    collectAttributes: function () {
        const groups = $("#attributes-container").find(".attribute-group");

        return groups.toArray().reduce(function (carry, item) {
            const $item = $(item);
            carry.attributes.push({
                attribute_type_id: $item.find(".attribute-type").val(),
                value: $item.find(".attribute-value").val()
            });
            return carry;
        }, {attributes: []});
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
    handleErrorMessages: function (data) {
        let messages = [];
        for (key in data) {
            messages = messages.concat(data[key]);
        }
        messages.map(function (message) {
            return new PNotify({text: message, type: "error"});
        });
    },
    showModal: function (content) {
        app.containers.modalContent.html(content);
        app.containers.modal.modal('show');
    },
    hideModal: function () {
        app.containers.modal.modal('hide');
    },
    retrieveTemplates: function () {
        let self = this;
        let a = $.get(self.routes.create)
            .done(function (htmlResponse) {
                self.htmlTemplates.create = $(htmlResponse);
            });
        let b = $.get(self.routes.attributeGroup)
            .done(function (htmlResponse) {
                self.htmlTemplates.attributeGroup = $(htmlResponse);
            });
        return $.when(a, b);
    },
    updateAttributeBlock: function (node) {

        function replaceElement($element, newType) {
            let attributes = {};
            let element = $element[0];

            $.each(element.attributes, function (i, attribute) {
                attributes[attribute.nodeName] = attribute.nodeValue;
            });

            $element = $element.replaceWith($("<" + newType + "/>", attributes)
                .val($element.attr('value'))
                .append($element.contents()));

        }

        let typeSelector = $(node);
        let selectedOption = typeSelector.children("option:selected");
        let inputType = selectedOption.data('input_type');
        let elementType = selectedOption.data('element_type');
        let fieldInput = $(node).parents('.attribute-form').find('.attribute-value');


        if (fieldInput[0].tagName == 'INPUT') {
            fieldInput.prop('type', inputType);
        }
        if (fieldInput[0].tagName != elementType) {
            replaceElement(fieldInput, elementType);
        }

    },
    binds: function () {
        let self = this;
        this.containers.main.on("click", ".add-contact", function (e) {
            self.actions.create();
        });
        this.containers.main.on("click", "#insert-new-attribute", function () {
            $("#attributes-container").append(self.htmlTemplates.attributeGroup.clone());
        });
        this.containers.main.on("click", ".remove-attribute-block", function () {
            if (!confirm("Are you sure you want to remove this item?")) {
                return;
            }
            $(this).parents('.attribute-group').remove();
        });
        this.containers.main.on('submit', this.selectors.forms.creation, function (e) {
            e.preventDefault();
            const formData = $(this).serializeArray().reduce(function (c, o) {
                if (o.value) {
                    c[o.name] = o.value;
                }
                return c;
            }, {});
            const attributesData = self.collectAttributes();
            const data = Object.assign({}, formData, attributesData);
            self.actions.store(data);
        });
        this.containers.main.on('submit', this.selectors.forms.edition, function (e) {
            e.preventDefault();
            let action = this.getAttribute('action');
            const formData = $(this).serializeArray().reduce(function (c, o) {
                if (o.value) {
                    c[o.name] = o.value;
                }
                return c;
            }, {});
            const attributesData = self.collectAttributes();
            const data = Object.assign({}, formData, attributesData);
            self.actions.update(action, data);
        });
        this.containers.main.on('click', this.selectors.buttons.show, function () {
            let ref = this.dataset.ref;
            app.actions.show(ref);
        });
        this.containers.main.on('click', this.selectors.buttons.edit, function () {
            let ref = this.dataset.ref;
            app.actions.edit(ref);
        });
        this.containers.main.on('click', this.selectors.buttons.delete, function () {
            let ref = this.dataset.ref;
            app.actions.delete(ref);
        });
        this.containers.modal.on('hidden.bs.modal', function () {
            self.containers.modalContent.html('');
        });
        this.containers.main.on('change', '.attribute-value', function () {
            let input = $(this);
            let value = input.val();
            input.attr('value', value);
        });
        this.containers.main.on('change', '.attribute-type', function () {
            app.updateAttributeBlock(this);
        });
    },
    initialize: function () {
        return $.when(this.retrieveTemplates(), this.binds(), this.actions.refresh());
    }
};

module.exports = app;