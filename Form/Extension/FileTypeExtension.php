<?php

namespace H4md1\UploadableBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use H4md1\UploadableBundle\Filesystem\FilesystemAwareTrait;

class FileTypeExtension extends AbstractTypeExtension
{
    use FilesystemAwareTrait;

    /**
     * Returns the name of the type being extended.
     *
     * @return string The name of the type being extended
     */
    public function getExtendedType()
    {
        return 'file';
    }

    /**
     * Add the image_path option
     *
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setOptional(array('mapping'));
    }

    /**
     * Pass the image URL to the view
     *
     * @param FormView $view
     * @param FormInterface $form
     * @param array $options
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if (array_key_exists('mapping', $options)) {
            //$entityData = $form->getParent()->getData();
            //$fs = $this->fs->get($options['image_path']);

            //$view->vars['image_url'] = $imageUrl;

            /*if($imageUrl)
            {
                // then set fileUpload as optional
                $view->vars['required'] = false;
            }*/
        }
    }

}