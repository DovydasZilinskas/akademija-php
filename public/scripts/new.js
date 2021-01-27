jQuery(document).ready(function () {
    var $tagsCollectionHolder = $('div.duties');
    
    $tagsCollectionHolder.data('index', $tagsCollectionHolder.find('input').length);
    
    $('body').on('click', '.add_item_link', function (e) {
    var $collectionHolderClass = $(e.currentTarget).data('collectionHolderClass');
    
    addFormToCollection($collectionHolderClass);
    })
    });
    
    function addFormToCollection($collectionHolderClass) {
    
    var $collectionHolder = $('.' + $collectionHolderClass);
    
    var prototype = $collectionHolder.data('prototype');
    
    var index = $collectionHolder.data('index');
    
    var newForm = prototype;
    
    newForm = newForm.replace(/__name__/g, index);
    
    $collectionHolder.data('index', index + 1);
    
    var $newFormLi = $('<div class="add-duty"></div>').append(newForm);
    
    $newFormLi.append('<button class="btn-delete remove-tag" type="button">Delete</button>');
    
    $collectionHolder.append($newFormLi)
    
    $newFormLi.before($newFormLi);
    
    $('.remove-tag').click(function (e) {
    e.preventDefault();
    
    $(this).parent().remove();
    
    return false;
    });
    }