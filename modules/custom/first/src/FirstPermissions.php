<?php
// in FilterPermissions.php
namespace Drupal\first;

class FirstPermissions {


    /**
     * Constructs a new FilterPermissions instance.
     *
     * @param \Drupal\Core\Entity\EntityManagerInterface $entity_manager
     *   The entity manager.
     */

    public function permissions() {
//        $permissions = [];
//
//        // Generate permissions for each text format. Warn the administrator that any
//        // of them are potentially unsafe.
//
//        /** @var \Drupal\filter\FilterFormatInterface[] $formats */
//        $formats = $this->entityManager
//            ->getStorage('first_format')
//            ->loadByProperties([
//                'status' => TRUE,
//            ]);
//        uasort($formats, 'Drupal\\Core\\Config\\Entity\\ConfigEntityBase::sort');
//        foreach ($formats as $format) {
//            if ($permission = $format
//                ->getPermissionName()) {
//                $permissions[$permission] = [
//                    'title' => $this
//                        ->t('Use the <a href=":url">@label</a> text format', [
//                            ':url' => $format
//                                ->url(),
//                            '@label' => $format
//                                ->label(),
//                        ]),
//                    'description' => [
//                        '#prefix' => '<em>',
//                        '#markup' => $this
//                            ->t('Warning: This permission may have security implications depending on how the text format is configured.'),
//                        '#suffix' => '</em>',
//                    ],
//                ];
//            }
//        }
//        return $permissions;
    }
}

