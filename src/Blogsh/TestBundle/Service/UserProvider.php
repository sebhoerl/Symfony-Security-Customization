<?php

namespace Blogsh\TestBundle\Service;
 
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\User;
 
class UserProvider implements UserProviderInterface {
    
    public function loadUserByUsername( $username ) {
        $file = file_get_contents( __DIR__ . '/../Resources/users.list' );
        $users = explode( "\n", $file );
        foreach ( $users as $user ) {
            list( $name, $password ) = explode( "=", $user );
            if ( $name == $username ) return new User( $name, $password );
        }
        throw new UsernameNotFoundException( sprintf( "Username %s not found", $username ) );
    }
    
    
    public function refreshUser( UserInterface $user ) {
        return $this->loadUserByUsername( $user->getUsername() );
    }
    
    public function supportsClass( $class ) {
        return $class === 'Symfony\Component\Security\Core\User\User';
    }
    
}