corrupt disk

sudo dd if=/dev/zero of=/dev/sdc bs=512 count=16

this will write nulls to initial sectors and this will result in unreadable filesystem.


copyingg disk image (.iso) to usb doesn't need a formated disk because dd command writes as it is
and it creates completely new filesystem


there are three levels of connection with usb:
mount => umount => eject
dd commands need umount condition but usb must not be ejected.
