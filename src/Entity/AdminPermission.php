<?php

namespace In\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use In\Repository\AdminPermissionRepository;

#[ORM\Entity(repositoryClass: AdminPermissionRepository::class)]
class AdminPermission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 20)]
    private ?string $role;

    #[ORM\Column(type: 'string', length: 100)]
    private ?string $name;

    /**
     * Many AdminPermission have one AdminRole.
     * @var AdminRoles
     */
    #[ORM\ManyToMany(targetEntity: 'AdminRole', mappedBy: 'adminPermissions')]
    private $adminRoles;

    public function __construct()
    {
        $this->adminRoles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, AdminRole>
     */
    public function getAdminRoles(): Collection
    {
        return $this->adminRoles;
    }

    public function addAdminRole(AdminRole $adminRole): self
    {
        if (!$this->adminRoles->contains($adminRole)) {
            $this->adminRoles[] = $adminRole;
            $adminRole->addAdminPermission($this);
        }

        return $this;
    }

    public function removeAdminRole(AdminRole $adminRole): self
    {
        if ($this->adminRoles->removeElement($adminRole)) {
            $adminRole->removeAdminPermission($this);
        }

        return $this;
    }
}
