

<?php $__env->startSection('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Ubah Soal</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo e(route('school_admin.index')); ?>">Beranda</a></div>
            <div class="breadcrumb-item active"><a href="<?php echo e(route('school_admin.exams.index')); ?>">Kumpulan Ujian</a></div>
            <div class="breadcrumb-item active"><a href="<?php echo e(route('school_admin.exams.questions.index', $exam->id)); ?>"><?php echo e($exam->name); ?></a></div>
            <div class="breadcrumb-item">Ubah Soal</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Ubah soal untuk <?php echo e($exam->name); ?> </h4>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('school_admin.exams.questions.update', [$exam->id, $question->id])); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Soal</label>
                        <div class="col-sm-12 col-md-7">
                            <textarea name="question" id="question" cols="30" rows="10" class="ckeditor-2"><?php echo $question->question; ?></textarea>
                        </div>
                    </div>
                    <div class="type_content">
                        <?php if($question->question_type == 'PG'): ?>
                        <div class="opsi_pg">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Opsi</label>
                                <div class="col-sm-12 col-md-7">
                                    <table class="w-100" id="optionpgtable">
                                        <?php $__currentLoopData = json_decode($question->option); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="py-2">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" id="opsi<?php echo e($key); ?>" name="answer" value="<?php echo e($key); ?>" <?php echo e($question->answer == $key ? 'checked' : ''); ?>>
                                                    <label class="custom-control-label" for="opsi<?php echo e($key); ?>"></label>
                                                </div>
                                            </td>
                                            <td class="py-2">
                                                <textarea name="option[<?php echo e($key); ?>]" id="option<?php echo e($key); ?>" cols="30" rows="10" class="ckeditor-2"><?php echo $option; ?></textarea>
                                            </td>
                                            <td class="align-top py-2">
                                                <button class="btn btn-light ml-2 removeOption"><i class="fa fa-times"></i></button>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </table>
                                    <div class="text-right mt-3">
                                        <button class="btn btn-light" id="addoptionpg">Tambah Opsi</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php elseif($question->question_type == 'ESAI'): ?>
                        <div class="opsi_esai">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Rekomendasi Jawaban</label>
                                <div class="col-sm-12 col-md-7">
                                    <textarea name="answer" id="answer" cols="30" rows="10" class="ckeditor-2"><?php echo $question->answer; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Maksimal Poin</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="number" name="poin" id="poin" class="form-control" value="<?php echo e($question->poin); ?>">
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

<script>

    $(document).on('click', '#addoptionpg', function(e) {
        e.preventDefault();

        var curIndex = $('#optionpgtable').find('tr').length;

        if (curIndex < 5) {
            $('#optionpgtable').append(`<tr>
                <td class="py-2">
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="opsi${ toString(curIndex) }" name="answer" value="${ toString(curIndex) }">
                        <label class="custom-control-label" for="opsi${ toString(curIndex) }"></label>
                    </div>
                </td>
                <td class="py-2">
                    <textarea name="option[${toString(curIndex)}]" id="option${curIndex}" cols="30" rows="10" class="ckeditor-2"></textarea>
                </td>
                <td class="align-top py-2">
                    <button class="btn btn-light ml-2 removeOption"><i class="fa fa-times"></i></button>
                </td>
            </tr>`);
    
            $('#optionpgtable').find('tr:last-child').find('.ckeditor-2').each((ind, el) => {
                initCkeditor(el);
            });
        } else {
            alert('Opsi tidak boleh lebih dari 5');
        }        
    });

    $(document).on('click', '.removeOption', function(e) {
        e.preventDefault();

        $(this).parents('tr').remove();

        resetName();
    });

    function resetName() {
        $('#optionpgtable').find('tr').each((ind, el) => {
            $(el).find('input[type=radio]').attr('value', toString(ind)).attr('id', `opsi${toString(ind)}`);
            $(el).find('label').attr('for', `opsi${toString(ind)}`);
            $(el).find('textarea').attr('id', `option${toString(ind)}`).attr('name', `option[${toString(ind)}]`);
        });;
    }

    function toString(i) {
        return String.fromCharCode('A'.charCodeAt(0) + i);
    }
</script>

<script src="<?php echo e(url('ckeditor/ckeditor.js')); ?>"></script>
<script>
    CKEDITOR.plugins.addExternal('ckeditor_wiris', '<?php echo e(url("ckeditor/node_modules/@wiris/mathtype-ckeditor4/plugin.js")); ?>');

    function initCkeditor(id) {
        var mathElements = [
            'math',
            'maction',
            'maligngroup',
            'malignmark',
            'menclose',
            'merror',
            'mfenced',
            'mfrac',
            'mglyph',
            'mi',
            'mlabeledtr',
            'mlongdiv',
            'mmultiscripts',
            'mn',
            'mo',
            'mover',
            'mpadded',
            'mphantom',
            'mroot',
            'mrow',
            'ms',
            'mscarries',
            'mscarry',
            'msgroup',
            'msline',
            'mspace',
            'msqrt',
            'msrow',
            'mstack',
            'mstyle',
            'msub',
            'msup',
            'msubsup',
            'mtable',
            'mtd',
            'mtext',
            'mtr',
            'munder',
            'munderover',
            'semantics',
            'annotation',
            'annotation-xml'
        ];

        CKEDITOR.replace(id, {
            extraPlugins: 'uploadimage,image2,ckeditor_wiris',
            height: 100,
            
            toolbar: [
                {
                    name: 'document',
                    items: ['Undo', 'Redo']
                },
                {
                    name: 'styles',
                    items: ['Format']
                },
                {
                    name: 'basicstyles',
                    items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat']
                },
                {
                    name: 'paragraph',
                    items: ['NumberedList', 'BulletedList']
                },
                {
                    name: 'links',
                    items: ['Link', 'Unlink']
                },
                {
                    name: 'presentation',
                    items: ['Image']
                },
                {
                    name: 'math',
                    items: ['ckeditor_wiris_formulaEditor']
                }
            ],

            // Upload images to a CKFinder connector (note that the response type is set to JSON).
            uploadUrl: "<?php echo e(route('web.upload_image')); ?>",

            filebrowserUploadUrl: "<?php echo e(route('web.upload_image')); ?>",
            filebrowserImageUploadUrl: "<?php echo e(route('web.upload_image')); ?>",

            stylesSet: [{
                    name: 'Narrow image',
                    type: 'widget',
                    widget: 'image',
                    attributes: {
                        'class': 'image-narrow'
                    }
                },
                {
                    name: 'Wide image',
                    type: 'widget',
                    widget: 'image',
                    attributes: {
                        'class': 'image-wide'
                    }
                }
            ],

            contentsCss: [
                'http://cdn.ckeditor.com/4.16.0/full-all/contents.css',
                'https://ckeditor.com/docs/ckeditor4/4.16.0/examples/assets/css/widgetstyles.css'
            ],

            image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
            image2_disableResizer: false,
            extraAllowedContent: mathElements.join(' ') + '()[]{*};img[data-mathml,data-custom-editor,role](Wirisformula)'
        });
    }

    $('.ckeditor-2').each((id, el) => {
        initCkeditor(el);
    });
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\event-ukline\resources\views/school_admin/exams/questions/create.blade.php ENDPATH**/ ?>
<?php /**PATH D:\xampp\htdocs\event-ukline\resources\views/school_admin/exams/questions/edit.blade.php ENDPATH**/ ?>