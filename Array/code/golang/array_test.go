package golang

// go test -v

import (
	"testing"
)

func TestArray_NewArray(t *testing.T) {
	NewArray(20)
}

func TestArray_IsEmpty(t *testing.T) {
	arr := NewArray(20)
	if !arr.IsEmpty() {
		t.Fail()
	}
}

func TestArray_Length(t *testing.T) {
	arr := NewArray(20)
	if arr.Length() != 0 {
		t.Fail()
	}
}

func TestArray_MaxSize(t *testing.T)  {
	arr := NewArray(20)
	if arr.MaxSize() != 20 {
		t.Fail()
	}
}

func TestArray_IsFull(t *testing.T)  {
	arr := NewArray(20)
	if arr.IsFull() != false {
		t.Fail()
	}
}

func TestArray_AddFirst(t *testing.T)  {
	arr := NewArray(20)
	err := arr.AddFirst(18)
	if err != nil {
		t.Error(err.Error())
	}
	if arr.Get(0).(int) != 18 {
		t.Fail()
	}
}

func TestArray_AddLast(t *testing.T)  {
	arr := NewArray(20)
	err := arr.AddLast(22)
	if err != nil {
		t.Error(err.Error())
	}
	if arr.Get(arr.Length() - 1).(int) != 22 {
		t.Fail()
	}
}

func TestArray_IsExists(t *testing.T)  {
	arr := NewArray(20)
	err := arr.AddLast(22)
	if err != nil {
		t.Error(err.Error())
	}
	if arr.IsExists(22) == false {
		t.Fail()
	}
}

func TestArray_Set(t *testing.T)  {
	arr := NewArray(20)
	err := arr.AddFirst(22)
	if err != nil {
		t.Error(err.Error())
	}
	err = arr.Set(0, 20)
	if err != nil {
		t.Error(err.Error())
	}
	if arr.Get(0).(int) != 20 {
		t.Fail()
	}
}

func TestArray_Get(t *testing.T)  {
	arr := NewArray(20)
	err := arr.AddFirst(22)
	if err != nil {
		t.Error(err.Error())
	}
	if arr.Get(0).(int) != 22 {
		t.Fail()
	}
}

func TestArray_Find(t *testing.T)  {
	arr := NewArray(20)
	err := arr.AddFirst(1)
	err = arr.AddFirst(2)
	err = arr.AddFirst(3)
	if err != nil {
		t.Error(err.Error())
	}
	if arr.Find(2) != 1 {
		t.Fail()
	}
}

func TestArray_Del(t *testing.T)  {
	arr := NewArray(20)
	err := arr.AddFirst(1)
	err = arr.AddFirst(2)
	err = arr.AddFirst(3)
	if err != nil {
		t.Error(err.Error())
	}
	err = arr.Del(2)
	if err != nil {
		t.Error(err.Error())
	}
}