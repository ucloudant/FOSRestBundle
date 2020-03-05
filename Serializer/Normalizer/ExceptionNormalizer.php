<?php

/*
 * This file is part of the FOSRestBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\RestBundle\Serializer\Normalizer;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Normalizes Exception instances.
 *
 * @author Ener-Getick <egetick@gmail.com>
 *
 * @internal since 2.8
 */
class ExceptionNormalizer extends AbstractExceptionNormalizer implements NormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $data = [];

        if (isset($context['template_data']['status_code'])) {
            $data['code'] = $statusCode = $context['template_data']['status_code'];
        } elseif (isset($context['status_code'])) {
            $data['code'] = $statusCode = $context['status_code'];
        }

        $data['message'] = $this->getMessageFromThrowable($object, isset($statusCode) ? $statusCode : null);

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof \Throwable;
    }
}
