<?php

namespace Blogsh\TestBundle\Service;
 
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
 
class CeasarCipherEncoder implements PasswordEncoderInterface {
 
    const from = 'abcdefghijklmnopqrstuvwxyz';
    const to = 'gkxqyvnabmswzefitoclpjrdhu';
 
    public function encodePassword( $raw, $salt ) {
        return strtr( $raw, static::from, static::to );
    }
 
    public function isPasswordValid( $encoded, $raw, $salt ) {
        return $encoded === $this->encodePassword( $raw, $salt );
    }
 
}