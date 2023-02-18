<?php

namespace In\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use In\Repository\AdminRoleRepository;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: AdminRoleRepository::class)]
class AdminRole
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'uuid')]
    private ?Uuid $uuid;

    #[ORM\Column(type: 'string', length: 100)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;

    #[ORM\Column(type: 'datetime_immutable')]
    private $updatedAt;

    /**
     * One AdmiRole has many permissions. This is the inverse side.
     *
     */
    #[ORM\JoinTable(name: 'admin_role_permission')]
    #[ORM\ManyToMany(targetEntity: 'AdminPermission', inversedBy: 'adminRoles')]
    private $adminPermissions;

    /**
     * @var ArrayCollection
     */
    #[ORM\OneToMany(targetEntity: 'Admin', mappedBy: 'adminRole')]
    private $admins;

    public function __construct()
    {
        $this->adminPermissions = new ArrayCollection();
        $this->admins = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): ?Uuid
    {
        return $this->uuid;
    }

    public function setUuid(?Uuid $uuid): self
    {
        $this->uuid = $uuid;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, AdminPermission>
     */
    public function getAdminPermissions(): Collection
    {
        return $this->adminPermissions;
    }

    public function addAdminPermission(AdminPermission $adminPermission): self
    {
        if (!$this->adminPermissions->contains($adminPermission)) {
            $this->adminPermissions[] = $adminPermission;
        }

        return $this;
    }

    public function removeAdminPermission(AdminPermission $adminPermission): self
    {
        $this->adminPermissions->removeElement($adminPermission);

        return $this;
    }

    /**
     * @return Collection<int, Admin>
     */
    public function getAdmins(): Collection
    {
        return $this->admins;
    }

    public function addAdmin(Admin $admin): self
    {
        if (!$this->admins->contains($admin)) {
            $this->admins[] = $admin;
            $admin->setAdminRole($this);
        }

        return $this;
    }

    public function removeAdmin(Admin $admin): self
    {
        if ($this->admins->removeElement($admin)) {
            // set the owning side to null (unless already changed)
            if ($admin->getAdminRole() === $this) {
                $admin->setAdminRole(null);
            }
        }

        return $this;
    }
}
