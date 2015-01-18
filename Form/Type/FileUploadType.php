<?php

namespace H4md1\UploadableBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use H4md1\UploadableBundle\Form\DataTransformer\FileToPathTransformer;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FileUploadType extends AbstractType
{
    /**
     * @var \League\Flysystem\MountManager
     */
    private $um;

    public function setUploadManager($um){
        $this->um = $um;
        return $this;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new FileToPathTransformer($this->um);
        $builder->addModelTransformer($transformer);
    }

    /**
     * Add the image_path option
     *
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array('data_class' => null))
        ;
    }

    public function getParent()
    {
        return 'file';
    }

    public function getName()
    {
        return 'file_upload';
    }
}